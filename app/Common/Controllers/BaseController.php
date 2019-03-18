<?php
/**
 * Created by PhpStorm.
 * User: Pasa吴
 * Date: 2019/2/11
 * Time: 19:54
 */

namespace App\Common\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * @var 模型
     */
    private $model;

    /**
     * 构造方法
     * AdminBaseController constructor.
     */
    public function __construct()
    {

    }

    /**
     * 系统跳转
     * @param array $_data
     *                      status  状态
     *                      message  消息
     *                      data  数据
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function jump($_data = [])
    {
        if (!is_array($_data) || count($_data) > 4) return null;

        $default_data = [0, '', []];
        list($status, $message, $data) = $_data + $default_data;
        // status为数字的情况 写api
        if (is_numeric($status)) {
            return response()->json(['code' => $status, 'msg' => $message, 'data' => $data]);
        }

    }
    /**
     * 返回josn
     * @param array $_data
     *                      status  状态
     *                      message  消息
     *                      data  数据
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function show($_data = [])
    {
        if (!is_array($_data) || count($_data) > 4) return null;

        $default_data = [0, '', []];
        list($status, $message, $data) = $_data + $default_data;
        // status为数字的情况 写api
        if (is_numeric($status)) {
            return response()->json(['code' => $status, 'mes' => $message, 'data' => $data]);
        }

    }
}