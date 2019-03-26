<?php
/**
 * Created by PhpStorm.
 * User: Pasa吴
 * Date: 2019/3/26
 * Time: 14:51
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Common\Controllers\AdminBaseController;
use App\Common\Model\CaseCategory AS M_CaseCategory;

class CaseCategoryController  extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new M_CaseCategory();
        $this->field = $this->model->getField($this->model->getTable());
    }

    /**
     * 案例分类列表
     * @param Request $request
     * @return \Illuminate\admins\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $query  = $this->model->query();
        $param  = $this->_getParams([
            ['keyword',''],
            ['page','15'],
        ]);
        if (!empty($param['keyword'])) {
            $query->where('name', 'like', '%' . $param['keyword'] . '%');
        }
        $list = $query->orderBy('id', 'desc')->paginate($param['page']);
        return view('admin.case_category.index', compact('list', 'param'));
    }

    /**
     * 添加案例分类
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
        //获取一级分类
        $categoryList = $this->model->getOneLevelCategory();
        return view('admin.case_category.add',compact('categoryList'));
    }

    /**
     * 编辑案例分类
     * @param $id
     * @param Request $request
     * @return \Illuminate\admins\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View|null
     */
    public function edit($id)
    {
        $data = $this->model->where('id', $id)->first();

        if (request()->isMethod("post")) {

            $rs = $this->model->where('id', $id)->update($this->only($this->field));

            if ($rs) {
                return $this->jump([SUCCESS, MES_SUCCESS]);
            }
            return $this->jump([FAILED, MES_FAILED]);

        }
        //获取一级分类
        $categoryList = $this->model->getOneLevelCategory();
        return view('admin.case_category.edit',compact('categoryList','data'));
    }

    /**
     * 删除案例分类
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
}
