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
use Illuminate\Support\Facades\Cache;

use App\Common\Model\Role AS M_Role;


class AdminBaseController extends Controller
{
    /**
     * @var 模型
     */
    public $model;
    /**
     * 请求变量
     * @var array
     */
    public $param;
    /**
     * 表字段
     * @var
     */
    public $field;
    /**
     * 请求
     * @var array|Request|string
     */
    public $request;

    /**
     * 构造方法
     * AdminBaseController constructor.
     */
    public function __construct()
    {
        $this->request = request();
        $this->param   = request()->all();
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
     * 参数获取及过滤
     * @param array $params
     * @return array
     */
    public function _getParams($params=[]){
        if(empty($params)){
            return [];
        }
        $return_datas = [];
        foreach ($params as $param) {
                //获取return_参数
                $return_datas[$param[0]] = $this->request->input($param[0], $param[1]);
        }
        return $return_datas;
    }

    /**
     * 返回json
     * @param array $data 数据
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnJosn($data = [])
    {
        return response()->json($data);
    }

    /**
     * 根据字段接受数据
     * @param array $field 字段数组
     * @return array
     */
    public function only($field = [])
    {
        return request()->only($field);
    }
}