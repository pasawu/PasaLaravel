<?php
/**
 * Created by PhpStorm.
 * User: Pasa吴
 * Date: 2019/3/15
 * Time: 11:38
 */

namespace App\Common\Model;

class CaseCategory extends BaseModel
{
    /**
     * 声明表名
     * @var string
     */
    protected $table = 'official_case_category';
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
     * 获取一级分类
     * @return mixed
     */
    public function getOneLevelCategory(){
        return self::where('level','=',1)->get();
    }

}