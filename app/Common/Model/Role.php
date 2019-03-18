<?php
/**
 * Created by PhpStorm.
 * User: Pasa吴
 * Date: 2019/3/15
 * Time: 11:38
 */

namespace App\Common\Model;
use App\Common\Model\Node AS M_Node;

class Role extends BaseModel
{
    /**
     * 声明表名
     * @var string
     */
    protected $table = 'pasa_role';
    /**
     * 属性包含你不想被赋值的属性数组
     * @var array
     */
    protected $guarded = [];
    /**
     * Unix时间戳形式填充创建于和更新于（注：模型默认托管时间但是是datetime类型）
     * @var string
     */
    protected $dateFormat = 'U';

    // 获取角色的权限节点
    public function getRuleById($id)
    {
        $res = $this->select('rule')->where('id', $id)->first();

        return $res['rule'];
    }
    /**
     * 获取角色信息
     * @param $id
     */
    public function getRoleInfo($id)
    {
        $M_Node = (new M_Node())->query();
        $result = $this->where('id', $id)->first();
        // 超级管理员权限是 *
        if(empty($result['rule'])){
            $result['action'] = '';
            return $result;
        }else if('*' == $result['rule']){
            //$where = '';
        }else{
            $result['rule'] = explode(',',$result['rule']);
            foreach ($result['rule'] as $key=>$value){
                $whereIn[] = $value;
            }
            $M_Node->whereIn('id',$whereIn);
        }

        // 查询权限节点
        $res = $M_Node->get();
        $_result = [];
        foreach($res as $key=>$vo){
            if('#' != $vo['action_name']){
                $_result['action'][] = $vo['control_name'] . '/' . $vo['action_name'];
            }
        }
        return $_result;
    }
}