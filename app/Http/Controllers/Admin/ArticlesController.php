<?php
/**
 * Created by PhpStorm.
 * articles: Pasa吴
 * Date: 2019/3/15
 * Time: 11:38
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Common\Controllers\AdminBaseController;
use App\Common\Model\articles AS M_articles;

class ArticlesController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new M_articles();
        $this->field = $this->model->getField($this->model->getTable());
    }

    /**
     * 文章列表
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
                $return['rows'][$key]['image'] = '<img src="' . $value['image'] . '" width="40px" height="40px">';
                $return['rows'][$key]['operate'] = showOperate($this->makeButton($value['id']));
            }
            return $this->returnJosn($return);
        }

        return view('admin.articles.index', compact('keyword'));
    }

    /**
     * 添加文章
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
        return view('admin.articles.add');
    }

    /**
     * 编辑文章
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
        //获取文章列表
        return view('admin.articles.edit', compact('data'));
    }

    /**
     * 删除文章
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
                'auth'     => 'admin/articles/edit',
                'href'     => url('admin/articles/edit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon'     => 'fa fa-paste'
            ],
            '删除' => [
                'auth'     => 'admin/articles/delete',
                'href'     => "javascript:del(" . $id . ")",
                'btnStyle' => 'danger',
                'icon'     => 'fa fa-trash-o'
            ]
        ];
    }
}
