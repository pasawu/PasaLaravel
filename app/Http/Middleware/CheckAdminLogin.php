<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Common\Model\Role AS M_Role;
class CheckAdminLogin

{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty(session('id'))) {
            return redirect('admin/login/index')->withErrors(['errors' => '登录超时，请重新登录']);
        }
        $actions=explode('\\', \Route::current()->getActionName());
        //$actions=explode('\\', \Route::currentRouteAction());

        $func=explode('@', $actions[count($actions)-1]);

        $controllerName=$func[0];
        $actionName=$func[1];

        // 检测权限
        $control = strtolower(str_replace('Controller','',$controllerName));
        $action  = $actionName;
        $_action = Cache::get(session('role_id'));
//        if (is_null($_action) || empty($_action)) {
            // 获取该管理员的角色信息
            $roleModel = new M_Role();
            $info      = $roleModel->getRoleInfo(session('role_id'));
            Cache::forever(session('role_id'), $info['action']);
//        }
        if (empty(authCheck('admin/'.$control . '/' . $action))) {
            return redirect('admin/index/welcome')->withErrors(['errors' => '您没有访问权限']);
        }
        return $next($request);

    }

}