<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//登录页面
Route::any('admin/login/index', 'Admin\LoginController@index');
Route::any('admin/index/index2', 'Admin\IndexController@index');
//登录接口
Route::any('admin/login/login', 'Admin\LoginController@login');
//退出
Route::any('admin/login/loginOut', 'Admin\LoginController@loginOut');

/**
 * 后台增删改查
 */
Route::group(['middleware' => ['CheckAdminLogin']], function () {

    //后台首页
    Route::any('admin/index/index', 'Admin\IndexController@index');
    Route::any('admin/index/welcome', 'Admin\IndexController@welcome');

    //管理员
    Route::any('admin/admin/index', 'Admin\AdminController@index');
    Route::any('admin/admin/add', 'Admin\AdminController@add');
    Route::any('admin/admin/edit/{id}', 'Admin\AdminController@edit');
    Route::any('admin/admin/delete/{id}', 'Admin\AdminController@delete');

    //角色
    Route::any('admin/role/giveAccess', 'Admin\RoleController@giveaccess');
    Route::any('admin/role/index', 'Admin\RoleController@index');
    Route::any('admin/role/add', 'Admin\RoleController@add');
    Route::any('admin/role/edit/{id}', 'Admin\RoleController@edit');
    Route::any('admin/role/delete/{id}', 'Admin\RoleController@delete');

    //节点
    Route::any('admin/node/indexdata', 'Admin\NodeController@indexdata');
    Route::any('admin/node/index', 'Admin\NodeController@index');
    Route::any('admin/node/add', 'Admin\NodeController@add');
    Route::any('admin/node/edit', 'Admin\NodeController@edit');
    Route::any('admin/node/delete', 'Admin\NodeController@delete');

    //修改信息
    Route::any('admin/profile/headedit', 'Admin\ProfileController@headedit');
    Route::any('admin/profile/upload', 'Admin\ProfileController@upload');
    Route::any('admin/profile/wangEditorUpload', 'Admin\ProfileController@wangEditorUpload');

    //用户
    Route::any('admin/user/index', 'Admin\UserController@index');
    Route::any('admin/user/add', 'Admin\UserController@add');
    Route::any('admin/user/edit/{id}', 'Admin\UserController@edit');
    Route::any('admin/user/delete/{id}', 'Admin\UserController@delete');

    //文章
    Route::any('admin/articles/index', 'Admin\ArticlesController@index');
    Route::any('admin/articles/add', 'Admin\ArticlesController@add');
    Route::any('admin/articles/edit/{id}', 'Admin\ArticlesController@edit');
    Route::any('admin/articles/delete/{id}', 'Admin\ArticlesController@delete');

});
