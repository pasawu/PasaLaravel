<?php
/**
 * Pasa吴
 * 2019年2月7日23:55:53
 */
namespace App\Common\Logic;

use App\Common\Model\BaseModel;

/*
*	逻辑基类
*/
class LogicBase extends BaseModel
{
    public function __construct(){
    }
    /**
     * @var model
     */
    public $model;

    /**
     * @var error 错误信息
     */
    public $error = '';

    /**
     * 获取分页参数
     * @param $data
     * @return mixed
     */
    public function getPage($data){
        if(empty($data['psize'])){
            $data['psize'] = 10;
        }
        if(empty($data['page'])){
            $data['page'] = 1;
        }
        return $data;
    }

}

?>