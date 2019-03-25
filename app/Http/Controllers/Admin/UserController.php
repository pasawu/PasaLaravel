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
use App\Common\Model\User AS M_User;

class UserController  extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new M_User();
        $this->field = $this->model->getField($this->model->getTable());
    }

    /**
     * 用户列表
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
                $query->where('mobile', 'like', '%' . $param['keyword'] . '%');
            }
            $return['total'] = $query->count();
            $return['rows']  = $query->orderBy('id', 'desc')->offset($offset)->limit($param['pageSize'])->get();

            foreach ($return['rows'] as $key => $value) {
                $return['rows'][$key]['operate']   = showOperate($this->makeButton($value['id']));
            }
            return $this->returnJosn($return);
        }

        return view('admin.user.index', compact('keyword'));
    }

    /**
     * 添加用户
     * @return \Illuminate\admins\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        if (request()->isMethod("post")) {
            $param = $this->only($this->field);

            $param['password'] = md5($param['password']);

            $rs = $this->model->create($param);
            if ($rs) {
                return $this->jump([SUCCESS, MES_SUCCESS]);
            }
            return $this->jump([FAILED, MES_FAILED]);
        }
        return view('admin.user.add');
    }

    /**
     * 编辑用户
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
        //获取用户列表
        return view('admin.user.edit', compact('data'));
    }

    /**
     * 删除用户
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
     * 拼装操作按钮
     * @param $id
     * @return array
     */
    private function makeButton($id)
    {
        return [
            '编辑' => [
                'auth'     => 'admin/user/edit',
                'href'     => url('admin/user/edit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon'     => 'fa fa-paste'
            ],
            '删除' => [
                'auth'     => 'admin/user/delete',
                'href'     => "javascript:del(" . $id . ")",
                'btnStyle' => 'danger',
                'icon'     => 'fa fa-trash-o'
            ]
        ];
    }
}
