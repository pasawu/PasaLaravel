<?php
/**
 * Created by PhpStorm.
 * User: Pasa吴
 * Date: 2019/2/19
 * Time: 9:30
 */

namespace App\Common\Logic;

use App\Common\Model\Business as M_Business;
use Illuminate\Support\Facades\Schema;

class Business extends LogicBase
{
    /**
     *  构造方法
     * @access public
     * @return object
     */
    public function __construct()
    {
        parent::__construct();
        //初始化模型
        $this->model = new M_Business();
    }

    /**
     * 新增商机
     * @param $param
     * @return array
     */
    public function add($param)
    {
        $return = $this->model->create($param);
        if ($return) {
            return [1, '新增商机成功', $return->id];
        } else {
            return [1, '网络错误', []];
        }
    }

    /**
     * 商机列表
     * @param $param
     * @return array
     */
    public function list($param)
    {
        $param = $this->getPage($param);
        $query = $this->model->query();
        //获取时间筛选范围
        $whereBetween = $this->getWhereDateParam($param);
        //获取where参数
        $where = $this->getWhereParam($param);

        if ($where) {
            $query->where($where);
        }

        if ($whereBetween) {
            $query->whereBetween('estimate_time',$whereBetween);
        }

        $data['list'] = $query->paginate($param['psize'], $columns = ['*'], $pageName = '', $param['page']);

        return [1, '获取商机列表成功', $data];
    }

    public function getWhereParam($param)
    {
        $where = [];

        if (!empty($param['principal_name'])) {
            $where[] = ['principal_name', '=', $param['principal_name']];
        }
        if (!empty($param['keyword'])) {
            $where[] = ['title', 'like', '%' . $param['keyword'] . '%'];
        }
        return $where;
    }

    public function getWhereDateParam($param)
    {
        $whereBetween = [];
        if (!empty($param['estimate_time'])) {
            switch ($param['estimate_time']) {
                case 'nowadays':
                    //今天
                    $start = date('Y-m-d H:i:s', mktime(0, 0, 0, date('m'), date('d'), date('Y')));
                    $end   = date('Y-m-d H:i:s', mktime(23, 59, 59, date('m'), date('d'), date('Y')));
                    break;
                case 'tomorrow':
                    //明天
                    $start = date('Y-m-d H:i:s', mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')));
                    $end   = date('Y-m-d H:i:s', mktime(23, 59, 59, date('m'), date('d') + 1, date('Y')));
                    break;
                case 'week':
                    //本周   date('d')-date('w')+1  date('d')==20号，date('w')==星期3，20-3+1=18,18号是周一 “当前时间2019年2月20日22:31:55”
                    $start = date('Y-m-d H:i:s', mktime(0, 0, 0, date('m'), date('d') - date('w') + 1, date('Y')));
                    $end   = date('Y-m-d H:i:s', mktime(23, 59, 59, date('m'), date('d') - date('w') + 7, date('Y')));
                    break;
                case 'next_week':
                    //下周   date('d')-date('w')+1  date('d')==20号，date('w')==星期3，20-3+8=25,25号是下周一 “当前时间2019年2月20日22:31:55”
                    $start = date('Y-m-d H:i:s', mktime(0, 0, 0, date('m'), date('d') - date('w') + 8, date('Y')));
                    $end   = date('Y-m-d H:i:s', mktime(23, 59, 59, date('m'), date('d') - date('w') + 14, date('Y')));
                    break;
                case 'this_month':
                    //本月
                    $start = date('Y-m-d H:i:s', mktime(0, 0, 0, date('m'), 1, date('Y')));
                    $end   = date('Y-m-d H:i:s', mktime(23, 59, 59, date('m'), date('t'), date('Y')));
                    break;
                case 'next_month':
                    //下个月
                    $start = date('Y-m-d H:i:s', mktime(0, 0, 0, date('m') + 1, 1, date('Y')));
                    $day   = date('t', strtotime($start));
                    $end   = date('Y-m-d H:i:s', mktime(23, 59, 59, date('m') + 1, $day, date('Y')));
                    break;
                default:
                    ;
            }
            $whereBetween = [strtotime($start), strtotime($end)];

        }
        return $whereBetween;
    }

}