<?php
/**
 * Pasa吴
 * 2019年2月13日17:48:48
 */
namespace App\Common\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class BaseModel extends Model
{
    /**
     * 声明表名
     * @var string
     */
    protected $table = '';
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
     * 获取表所有字段
     * @return mixed
     */
    public static function getField($table){
        return $columns = Schema::getColumnListing($table);
    }
}