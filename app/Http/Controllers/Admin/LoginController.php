<?php
/**
 * Created by PhpStorm.
 * User: Pasa吴
 * Date: 2019/3/15
 * Time: 11:38
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use App\Common\Controllers\AdminBaseController;
use App\Common\Model\Admin AS M_Admin;
use App\Common\Model\Role AS M_Role;

class LoginController extends AdminBaseController
{

    /**
     * 登录页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (!empty(session('id'))) {
            return redirect('admin/index/index')->withErrors(['errors' => '您已经登录!']);
        }
        return view('admin.login.index');
    }


    public function login(Request $request)
    {
        header("Content-type:text/html;charset=utf-8");

        $userName = $this->param['user_name'];
        $password = $this->param['password'];
        $captcha  = $this->param['captcha'];

        $validator = Validator::make($this->param, [
            'captcha' => 'required|captcha',
        ], [
            'captcha.required' => '验证码不能为空',
            'captcha.captcha'  => '请输入正确的验证码',
        ]);

        if ($validator->fails()) {
            return $this->jump([0, $validator->errors()->first(), []]);
        }

        $hasUser = M_Admin::where('user_name', $userName)->first();
        $hasUser = json_decode(json_encode($hasUser), true);
        if (is_null($hasUser)) {
            return $this->jump([0, '管理员不存在', []]);
        }
        if (md5($password) != $hasUser['password']) {
            return $this->jump([0, '密码错误', []]);
        }

        if (1 != $hasUser['status']) {
            return $this->jump([0, '该账号被禁用', []]);
        }
        $role = M_Role::where('id', $hasUser['role_id'])->first();

        session::put('username', $hasUser['user_name']);
        session::put('id', $hasUser['id']);
        session::put('head', $hasUser['head']);
        session::put('role', $role['role_name']);  // 角色名
        session::put('role_id', $hasUser['role_id']);

        session::put('rule', $role['rule']);

        // 更新管理员状态
        $param = [
            'login_times'     => $hasUser['login_times'] + 1,
            'last_login_ip'   => request()->ip(),
            'last_login_time' => time(),
        ];
        M_Admin::where('id', $hasUser['id'])->update($param);
        return $this->jump([1, '登录成功', url('admin/index/index')]);
        // ['code' => 1, 'data' => url('index/index'), 'msg' => '登录成功']
    }

    /**
     * 退出
     */
    public function loginOut()
    {
        session::put('username', null);
        session::put('id', null);
        session::put('head', null);
        session::put('role', null);  // 角色名
        session::put('role_id', null);
        session::put('rule', null);

        return redirect('admin/login/index')->withErrors(['errors' => '退出成功']);
    }

}
