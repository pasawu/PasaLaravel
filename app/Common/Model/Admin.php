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
use Illuminate\Support\Facades\DB;

class Admin extends BaseModel
{
    use SoftDeletes;
    /**
     * 应该被调整为日期的属性
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    /**
     * 声明表名
     * @var string
     */
    protected $table = 'pasa_admin';
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
     * 根据用户名检测用户数据
     * @param $userName
     */
    public function checkUser($userName)
    {
//        return $this->alias('u')
//            ->field('u.id,u.user_name,r.role_name,u.role_id,u.head,r.rule,u.password,u.status,u.login_times')
//            ->join('role r', 'u.role_id = r.id')
//            ->where('u.user_name', $userName)
//            ->find();
        return DB::table('pasa_admin')
            ->join('pasa_role', 'pasa_admin.role_id', '=', 'pasa_role.id')
            ->where('pasa_admin.user_name', $userName)
            ->first();
    }
    public function roleInfo(){

        return $this->hasOne('App\Common\Model\Role','id','role_id');

    }




}