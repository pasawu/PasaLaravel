<?php
/**
 * Created by PhpStorm.
 * User: Pasa吴
 * Date: 2019/3/15
 * Time: 11:38
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Controllers\AdminBaseController;
use App\Common\Model\Node AS M_Node;
use Illuminate\Support\Facades\Session;

class IndexController extends AdminBaseController
{

    /**
     * 后台首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $menu= M_Node::getMenu(session('rule'));
        $menu= M_Node::getMenu('*');
        return view('admin.index.index',compact('menu'));
    }

    /**
     * 欢迎页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome()
    {
        return view('admin.index.welcome');
    }
}
