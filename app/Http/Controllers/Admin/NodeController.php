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
use App\Common\Model\Node AS M_Node;

class NodeController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new M_Node();
        $this->field = $this->model->getField($this->model->getTable());
    }

    /**
     * 节点列表
     * @param Request $request
     * @return \Illuminate\admins\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.node.index');
    }

    public function indexdata()
    {
        $nodes = $this->model->select('id', 'node_name as name', 'type_id as pid', 'is_menu', 'style', 'control_name', 'action_name')->get();
        $nodes = getTree(objToArray($nodes), false);
        return $this->jump([SUCCESS, MES_SUCCESS, $nodes]);
    }

    /**
     * 添加节点
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
        return view('admin.node.add');
    }

    /**
     * 编辑节点
     * @param $id
     * @param Request $request
     * @return \Illuminate\admins\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View|null
     */
    public function edit()
    {
        $id = $this->param['id'];
        $data = $this->model->where('id', $id)->first();

        if (request()->isMethod("post")) {

            $rs = $this->model->where('id', $id)->update($this->only($this->field));

            if ($rs) {
                return $this->jump([SUCCESS, MES_SUCCESS]);
            }
            return $this->jump([FAILED, MES_FAILED]);

        }
        //获取角色列表
        return view('admin.node.edit', compact('data'));
    }

    /**
     * 删除节点
     * @param $id
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function delete()
    {
        $id = $this->param['id'];
        $rs = $this->model->destroy($id);
        if ($rs) {
            return $this->jump([SUCCESS, MES_SUCCESS]);
        }
        return $this->jump([FAILED, MES_FAILED]);
    }
}
