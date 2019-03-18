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
use App\Common\Model\Admin AS M_Admin;
use App\Common\Model\Node AS M_Node;

class ProfileController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new M_Admin();
        $this->field = $this->model->getField($this->model->getTable());
    }

    public function headedit()
    {
        $data = $this->model->where('id', session('id'))->first();
        if (request()->isMethod("post")) {
            $param = $this->only($this->field);
            if (empty($param['password'])) {
                unset($param['password']);
            } else {
                $param['password'] = md5($param['password']);
            }
            $rs = $this->model->where('id', session('id'))->update($param);

            if ($rs) {
                return $this->jump([SUCCESS, MES_SUCCESS]);
            }
            return $this->jump([FAILED, MES_FAILED]);

        }

        return view('admin.profile.headedit', compact('data'));
    }

    //图片上传
    public function upload()
    {

        $file = $this->request->file('file');
        if ($file->isValid()) {
            $entension   = $file->getClientOriginalExtension();//获得上传文件后缀
            $newName     = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;
            $path        = $file->move(base_path() . '/public/uploads', $newName);//上传文件到服务器指定目录，并重命名【备注：base_path(）指的是该程序根目录】
            $filepath    = '/uploads/' . $newName; //给用户一个相对路径
            $data['src'] = $filepath;
            return $this->jump([FAILED, MES_FAILED, $data]);
        }
    }
}
