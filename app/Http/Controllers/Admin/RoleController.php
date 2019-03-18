<?php
/**
 * Created by PhpStorm.
 * User: Pasa吴
 * Date: 2019/3/15
 * Time: 11:38
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Common\Controllers\AdminBaseController;
use App\Common\Model\Role AS M_Role;
use App\Common\Model\Node AS M_Node;

class RoleController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new M_Role();
        $this->field = $this->model->getField($this->model->getTable());
    }

    /**
     * 角色列表
     * @param Request $request
     * @return \Illuminate\admins\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (request()->isMethod("post")) {

            $query  = $this->model->query();
            $param  = $this->param;
            $offset = ($param['pageNumber'] - 1) * $param['pageSize'];
            if (!empty($param['keyword'])) {
                $query->where('role_name', 'like', '%' . $param['keyword'] . '%');
            }
            $return['total'] = $query->count();
            $return['rows']  = $query->orderBy('id', 'desc')->offset($offset)->limit($param['pageSize'])->get();

            foreach ($return['rows'] as $key => $value) {
                $return['rows'][$key]['operate']   = showOperate($this->makeButton($value['id']));
            }
            return $this->returnJosn($return);
        }

        return view('admin.role.index', compact('keyword'));
    }

    /**
     * 添加角色
     * @return \Illuminate\admins\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        if (request()->isMethod("post")) {
            $rs = $this->model->create($this->only($this->field));
            if ($rs) {
                return $this->jump([SUCCESS, MES_SUCCESS]);
            }
            return $this->jump([FAILED, MES_FAILED]);
        }
        return view('admin.role.add');
    }

    /**
     * 编辑角色
     * @param $id
     * @param Request $request
     * @return \Illuminate\admins\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View|null
     */
    public function edit($id)
    {
        $data = $this->model->where('id', $id)->first();

        if (request()->isMethod("post")) {
            $param = $this->only($this->field);
            if (empty($param['password'])) {
                unset($param['password']);
            } else {
                $param['password'] = md5($param['password']);
            }
            $rs = $this->model->where('id', $id)->update($param);

            if ($rs) {
                return $this->jump([SUCCESS, MES_SUCCESS]);
            }
            return $this->jump([FAILED, MES_FAILED]);

        }
        //获取角色列表
        return view('admin.role.edit', compact('data'));
    }

    /**
     * 删除角色
     * @param $id
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function delete($id)
    {
        $rs = $this->model->destroy($id);
        if ($rs) {
            return $this->jump([SUCCESS, MES_SUCCESS]);
        }
        return $this->jump([FAILED, MES_FAILED]);
    }

    /**
     * 分配权限
     * @return mixed
     */
    public function giveAccess()
    {
        $param = $this->param;
        $node = new M_Node();
        // 获取现在的权限
        if('get' == $param['type']){
            $nodeStr = $node->getNodeInfo($param['id']);
            return $this->jump([SUCCESS, MES_SUCCESS,$nodeStr]);
        }

        // 分配新权限
        if('give' == $param['type']){

            $doparam = [
                'id' => $param['id'],
                'rule' => $param['rule']
            ];
            M_Role::where('id','=',$param['id'])->update($doparam);
            //TOO未完善

//            $this->removRoleCache();
            return $this->jump([SUCCESS, MES_SUCCESS]);
        }
    }
    /**
     * 拼装操作按钮
     * @param $id
     * @return array
     */
    private function makeButton($id)
    {
        return [
            '编辑' => [
                'auth'     => 'admin/role/edit',
                'href'     => url('admin/role/edit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon'     => 'fa fa-paste'
            ],
            '删除' => [
                'auth'     => 'admin/role/delete',
                'href'     => "javascript:del(" . $id . ")",
                'btnStyle' => 'danger',
                'icon'     => 'fa fa-trash-o'
            ],
            '分配权限' => [
                'auth' => 'admin/role/giveaccess',
                'href' => "javascript:giveQx(" .$id .")",
                'btnStyle' => 'info',
                'icon' => 'fa fa-institution'
            ],
        ];
    }
}
