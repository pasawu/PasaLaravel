<?php
/**
 * Created by PhpStorm.
 * User: Pasa吴
 * Date: 2019/3/15
 * Time: 11:38
 */
namespace App\Common\Model;

//软删除
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Common\Model\Role AS M_Role;

class Node extends BaseModel
{
    use SoftDeletes;
    /**
     * 应该被调整为日期的属性
     * @var array
     */
    protected $dates = ['created_at','updated_at','deleted_at'];
    /**
     * 声明表名
     * @var string
     */
    protected $table = 'pasa_node';
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


    /**
     * 根据节点数据获取对应的菜单
     * @param $nodeStr
     */
    public static function getMenu($nodeStr = '')
    {
        if(empty($nodeStr)){
            return [];
        }
        // 超级管理员没有节点数组 * 号表示
        $query = self::query();
        $query->where('is_menu','=','2');
        if($nodeStr!='*'){
            $query->where('is_menu','in',$nodeStr);
        }
        $result = $query->get();
        $result = prepareMenu($result);
        return $result;
    }
    /**
     * 获取节点数据
     */
    public static function getNodeInfo($id)
    {
        $result = self::get();
        $str = '';

        $role = new M_Role();
        $rule = $role->getRuleById($id);

        if(!empty($rule)){
            $rule = explode(',', $rule);
        }

        foreach($result as $key=>$vo){
            $str .= '{ "id": "' . $vo['id'] . '", "pId":"' . $vo['type_id'] . '", "name":"' . $vo['node_name'].'"';

            if(!empty($rule) && in_array($vo['id'], $rule)){
                $str .= ' ,"checked":1';
            }

            $str .= '},';

        }

        return '[' . rtrim($str, ',') . ']';
    }

}