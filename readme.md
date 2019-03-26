<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

PasaLarave基于laravel5.7和H+ 后台主题UI开发的通用后台管理系统

安装指导：配置一个域名指向public目录，修改.env配置文件

DB_HOST=127.0.0.1#数据库地址

DB_PORT=3306#数据库端口号

DB_DATABASE=pasalaravel#数据库名称

DB_USERNAME=root#数据库账号

DB_PASSWORD=root#数据库密码

然后导入根目录下pasalaravel.sql数据库

目前完成的功能有:

权限控制

后台管理员的增删改查

角色的增删改查

权限的分配

文章增删改查(集成wangEditor编辑器)

后台开发指导:按照分类管理来做增删改查,目前只有分类管理代码是封装好点，其他管理没有封装但也不需要修改.


后台界面截图
<img src="https://raw.githubusercontent.com/pasawu/PasaLaravel/master/public/uploads/1.png">
<img src="https://raw.githubusercontent.com/pasawu/PasaLaravel/master/public/uploads/2.png">
<img src="https://raw.githubusercontent.com/pasawu/PasaLaravel/master/public/uploads/3.png">
<img src="https://raw.githubusercontent.com/pasawu/PasaLaravel/master/public/uploads/4.png">
<img src="https://raw.githubusercontent.com/pasawu/PasaLaravel/master/public/uploads/5.png">

