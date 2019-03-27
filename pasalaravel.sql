/*
Navicat MySQL Data Transfer

Source Server         : 本机
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : pasalaravel

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-03-27 16:21:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for official_card_category
-- ----------------------------
DROP TABLE IF EXISTS `official_card_category`;
CREATE TABLE `official_card_category` (
  `id` int(30) NOT NULL AUTO_INCREMENT COMMENT '帖子表',
  `name` varchar(255) DEFAULT NULL COMMENT '帖子分类名称',
  `sort` int(30) DEFAULT NULL COMMENT '排序',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='帖子表';

-- ----------------------------
-- Records of official_card_category
-- ----------------------------

-- ----------------------------
-- Table structure for official_cases
-- ----------------------------
DROP TABLE IF EXISTS `official_cases`;
CREATE TABLE `official_cases` (
  `id` int(30) NOT NULL AUTO_INCREMENT COMMENT '案例表',
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `category_1` int(2) DEFAULT NULL COMMENT '一级分类',
  `category_2` int(2) DEFAULT NULL COMMENT '二级分类',
  `image` varchar(255) DEFAULT NULL COMMENT '封面图',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='案例表';

-- ----------------------------
-- Records of official_cases
-- ----------------------------
INSERT INTO `official_cases` VALUES ('1', '1', '1', '1', null, '1553669757', '1553669757', null);
INSERT INTO `official_cases` VALUES ('2', '12', '2', '2', '/uploads/201903270657384022.jpg', '1553669859', '1553670042', null);

-- ----------------------------
-- Table structure for official_case_category
-- ----------------------------
DROP TABLE IF EXISTS `official_case_category`;
CREATE TABLE `official_case_category` (
  `id` int(30) NOT NULL AUTO_INCREMENT COMMENT '案例分类表',
  `name` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `thumb` varchar(255) DEFAULT NULL COMMENT '分类图片',
  `parentid` int(30) DEFAULT '0' COMMENT '父ID',
  `displayorder` int(30) DEFAULT '0' COMMENT '排序',
  `level` int(30) DEFAULT '1' COMMENT '分类等级',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='案例分类表';

-- ----------------------------
-- Records of official_case_category
-- ----------------------------
INSERT INTO `official_case_category` VALUES ('1', '服装鞋包', '/uploads/201903260856065276.jpg', '0', '1', '1', '1553584418', '1553590604', null);
INSERT INTO `official_case_category` VALUES ('2', '食品生鲜', '/uploads/201903260713355365.JPG', '0', '1', '1', '1553584418', '1553593723', null);
INSERT INTO `official_case_category` VALUES ('3', '餐饮美食', '/uploads/201903260715157237.jpg', '0', '1', '1', '1553584517', '1553593736', null);
INSERT INTO `official_case_category` VALUES ('7', '软件开发', '/uploads/201903260949104599.jpg', '0', '1', '1', '1553593752', '1553593752', null);
INSERT INTO `official_case_category` VALUES ('8', '微信小程序', '/uploads/201903260951296916.jpg', '7', '2', '2', '1553593892', '1553593892', null);

-- ----------------------------
-- Table structure for official_user
-- ----------------------------
DROP TABLE IF EXISTS `official_user`;
CREATE TABLE `official_user` (
  `id` int(255) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `name` varchar(255) DEFAULT NULL COMMENT '用户名',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机号码',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of official_user
-- ----------------------------
INSERT INTO `official_user` VALUES ('1', null, '18111111111', null, 'b59c67bf196a4758191e42f76670ceba', '1552890335', '1553503357', null);
INSERT INTO `official_user` VALUES ('2', null, '18888888888', null, 'c4ca4238a0b923820dcc509a6f75849b', '1552890341', '1553503347', null);
INSERT INTO `official_user` VALUES ('5', '1', '1', '/uploads/201903270747342864.JPG', 'c4ca4238a0b923820dcc509a6f75849b', '1553672822', '1553672856', null);

-- ----------------------------
-- Table structure for pasa_admin
-- ----------------------------
DROP TABLE IF EXISTS `pasa_admin`;
CREATE TABLE `pasa_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '密码',
  `head` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '头像',
  `login_times` int(11) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `last_login_ip` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `real_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '真实姓名',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `role_id` int(11) NOT NULL DEFAULT '1' COMMENT '用户角色id',
  `deleted_at` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `updated_at` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of pasa_admin
-- ----------------------------
INSERT INTO `pasa_admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '/uploads/201903180329271036.JPG', '36', '127.0.0.1', '1553666595', 'admin', '1', '1', null, '1553666595', null);
INSERT INTO `pasa_admin` VALUES ('2', '1', '64d07a30f56ef59c79943ce26532c9e3', '/uploads/201903171035096569.JPG', '7', '127.0.0.1', '1552821020', '1', '1', '1', null, '1552821020', null);
INSERT INTO `pasa_admin` VALUES ('3', 'pasawu', 'd36ddfa2bf8c74f90bbd6747f152d200', '/uploads/201903171035096569.JPG', '6', '127.0.0.1', '1552877639', '123456', '1', '2', null, '1552877639', null);
INSERT INTO `pasa_admin` VALUES ('4', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552809053', '1552809053', '1552720085');
INSERT INTO `pasa_admin` VALUES ('5', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552809051', '1552809051', '1552720374');
INSERT INTO `pasa_admin` VALUES ('6', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552809049', '1552809049', '1552720418');
INSERT INTO `pasa_admin` VALUES ('7', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552809045', '1552809045', '1552720426');
INSERT INTO `pasa_admin` VALUES ('8', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552793355', '1552793355', '1552720546');
INSERT INTO `pasa_admin` VALUES ('9', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552793353', '1552793353', '1552720563');
INSERT INTO `pasa_admin` VALUES ('10', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552793351', '1552793351', '1552720566');
INSERT INTO `pasa_admin` VALUES ('11', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552793348', '1552793348', '1552720568');
INSERT INTO `pasa_admin` VALUES ('12', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552793346', '1552793346', '1552720570');
INSERT INTO `pasa_admin` VALUES ('13', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552793344', '1552793344', '1552720572');
INSERT INTO `pasa_admin` VALUES ('14', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552793342', '1552793342', '1552720574');
INSERT INTO `pasa_admin` VALUES ('15', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552793339', '1552793339', '1552720575');
INSERT INTO `pasa_admin` VALUES ('16', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552793337', '1552793337', '1552720580');
INSERT INTO `pasa_admin` VALUES ('17', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552793335', '1552793335', '1552720586');
INSERT INTO `pasa_admin` VALUES ('18', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552793332', '1552793332', '1552720616');
INSERT INTO `pasa_admin` VALUES ('19', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '2', '1552793330', '1552793330', '1552720833');
INSERT INTO `pasa_admin` VALUES ('20', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '2', '1552793328', '1552793328', '1552720837');
INSERT INTO `pasa_admin` VALUES ('21', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '2', '1552793325', '1552793325', '1552720841');
INSERT INTO `pasa_admin` VALUES ('22', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '2', '1', '1552793322', '1552793322', '1552722686');
INSERT INTO `pasa_admin` VALUES ('23', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '1', '1', '1552793223', '1552793223', '1552722689');
INSERT INTO `pasa_admin` VALUES ('24', '1', '1', '/uploads/201903171035096569.JPG', '0', '', '0', '1', '0', '1', '1552793205', '1552793205', '1552730384');
INSERT INTO `pasa_admin` VALUES ('25', '1', '', '/uploads/201903171035096569.JPG', '0', '', '0', '', '0', '1', null, '1552810003', '1552810003');

-- ----------------------------
-- Table structure for pasa_articles
-- ----------------------------
DROP TABLE IF EXISTS `pasa_articles`;
CREATE TABLE `pasa_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `title` varchar(155) DEFAULT NULL COMMENT '文章标题',
  `description` varchar(255) DEFAULT NULL COMMENT '文章描述',
  `image` varchar(255) DEFAULT NULL COMMENT '文章缩略图',
  `content` text NOT NULL COMMENT '文章内容',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pasa_articles
-- ----------------------------
INSERT INTO `pasa_articles` VALUES ('1', 'Pasalaravel基于laravel5.7开发通用后台管理', 'Pasalaravel基于laravel5.7开发通用后台管理', '/uploads/201903250336428328.jpg', '<p>Pasalaravel基于laravel5.7开发通用后台管理</p><p><img src=\"/uploads/201903250843002807.JPG\" style=\"max-width:100%;\"></p>', '1553485003', '1553503382', null);

-- ----------------------------
-- Table structure for pasa_banner
-- ----------------------------
DROP TABLE IF EXISTS `pasa_banner`;
CREATE TABLE `pasa_banner` (
  `id` int(30) NOT NULL AUTO_INCREMENT COMMENT '轮播图',
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `thumb` varchar(255) DEFAULT NULL COMMENT '图片',
  `sort` int(30) DEFAULT NULL COMMENT '排序',
  `is_display` int(2) DEFAULT NULL COMMENT '显示状态,1显示，2隐藏',
  `create_time` varchar(255) DEFAULT NULL,
  `update_time` varchar(255) DEFAULT NULL,
  `delete_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pasa_banner
-- ----------------------------
INSERT INTO `pasa_banner` VALUES ('1', '轮播图名称', '8', '1', '1', '1535526750', '1535528558', '1535528558');
INSERT INTO `pasa_banner` VALUES ('2', '轮播图名称', '10', '1', '1', '1535526832', '1535533125', null);
INSERT INTO `pasa_banner` VALUES ('3', '轮播图名称', '10', '1', '1', '1535528124', '1535528124', null);
INSERT INTO `pasa_banner` VALUES ('4', '轮播图名称', '10', '1', '1', '1535526832', '1535533125', null);
INSERT INTO `pasa_banner` VALUES ('5', '轮播图名称', '10', '1', '1', '1535526832', '1535533125', null);
INSERT INTO `pasa_banner` VALUES ('6', '轮播图名称', '10', '1', '1', '1535528124', '1535528124', null);
INSERT INTO `pasa_banner` VALUES ('7', '轮播图名称', '10', '1', '1', '1535526832', '1535533125', null);
INSERT INTO `pasa_banner` VALUES ('8', '轮播图名称', '10', '1', '1', '1535528124', '1535528124', null);
INSERT INTO `pasa_banner` VALUES ('9', '轮播图名称', '10', '1', '1', '1535526832', '1535533125', null);
INSERT INTO `pasa_banner` VALUES ('10', '轮播图名称', '10', '1', '1', '1535526832', '1535533125', null);
INSERT INTO `pasa_banner` VALUES ('11', '轮播图名称', '10', '1', '1', '1535526832', '1535533125', null);
INSERT INTO `pasa_banner` VALUES ('12', '轮播图名称', '10', '1', '1', '1535528124', '1535528124', null);
INSERT INTO `pasa_banner` VALUES ('13', '轮播图名称', '10', '1', '1', '1535526832', '1535533125', null);
INSERT INTO `pasa_banner` VALUES ('14', '轮播图名称', '10', '1', '1', '1535528124', '1535528124', null);
INSERT INTO `pasa_banner` VALUES ('15', '轮播图名称', '10', '1', '1', '1535526832', '1535533125', null);
INSERT INTO `pasa_banner` VALUES ('16', '轮播图名称', '10', '1', '1', '1535526832', '1535533125', null);
INSERT INTO `pasa_banner` VALUES ('17', '轮播图名称', '10', '1', '1', '1535526832', '1535533125', null);

-- ----------------------------
-- Table structure for pasa_node
-- ----------------------------
DROP TABLE IF EXISTS `pasa_node`;
CREATE TABLE `pasa_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_name` varchar(155) NOT NULL DEFAULT '' COMMENT '节点名称',
  `control_name` varchar(155) NOT NULL DEFAULT '' COMMENT '控制器名',
  `action_name` varchar(155) NOT NULL COMMENT '方法名',
  `is_menu` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否是菜单项 1不是 2是',
  `type_id` int(11) NOT NULL COMMENT '父级节点id',
  `style` varchar(155) DEFAULT '' COMMENT '菜单样式',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of pasa_node
-- ----------------------------
INSERT INTO `pasa_node` VALUES ('1', '用户管理', '#', '#', '2', '0', 'fa fa-users', '1552881243', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('2', '管理员管理', 'admin', 'index', '2', '1', '', '1552881507', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('3', '添加管理员', 'admin', 'add', '1', '2', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('4', '编辑管理员', 'admin', 'edit', '1', '2', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('5', '删除管理员', 'admin', 'delete', '1', '2', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('6', '角色管理', 'role', 'index', '2', '1', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('7', '添加角色', 'role', 'add', '1', '6', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('8', '编辑角色', 'role', 'edit', '1', '6', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('9', '删除角色', 'role', 'delete', '1', '6', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('10', '分配权限', 'role', 'giveaccess', '1', '6', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('15', '节点管理', 'node', 'index', '2', '1', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('16', '添加节点', 'node', 'add', '1', '15', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('17', '编辑节点', 'node', 'edit', '1', '15', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('18', '删除节点', 'node', 'delete', '1', '15', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('19', '文章管理', '#', '#', '2', '0', 'fa fa-book', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('20', '文章列表', 'articles', 'index', '2', '19', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('21', '添加文章', 'articles', 'add', '2', '19', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('22', '编辑文章', 'articles', 'edit', '1', '19', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('23', '删除文章', 'articles', 'delete', '1', '19', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('24', '上传图片', 'articles', 'uploadImg', '1', '19', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('25', '个人中心', '#', '#', '1', '0', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('26', '编辑信息', 'profile', 'index', '1', '25', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('27', '编辑头像', 'profile', 'headedit', '1', '25', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('28', '上传头像', 'profile', 'uploadheade', '1', '25', '', '1552881530', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('39', '用户管理', '#', '#', '2', '0', 'fa fa-book', '1552881243', '1552881243', null);
INSERT INTO `pasa_node` VALUES ('40', '添加用户', 'user', 'add', '2', '39', null, '1552881507', '1552881507', null);
INSERT INTO `pasa_node` VALUES ('41', '用户列表', 'user', 'index', '2', '39', null, '1552881530', '1552881530', null);
INSERT INTO `pasa_node` VALUES ('42', '编辑用户', 'user', 'edit', '1', '41', '', '1552881530', '1552881530', null);
INSERT INTO `pasa_node` VALUES ('43', '删除用户', 'user', 'delete', '1', '41', '', '1552881530', '1552881530', null);
INSERT INTO `pasa_node` VALUES ('44', '案例分类', '#', '#', '2', '0', 'fa fa-book', '1553582079', '1553582079', null);
INSERT INTO `pasa_node` VALUES ('49', '添加案例分类', 'case_category', 'add', '2', '44', '', '1552881507', '1552881507', null);
INSERT INTO `pasa_node` VALUES ('50', '案例分类列表', 'case_category', 'index', '2', '44', '', '1552881530', '1552881530', null);
INSERT INTO `pasa_node` VALUES ('51', '编辑案例分类', 'case_category', 'edit', '1', '50', '', '1552881530', '1552881530', null);
INSERT INTO `pasa_node` VALUES ('52', '删除案例分类', 'case_category', 'delete', '1', '50', '', '1552881530', '1552881530', null);


-- ----------------------------
-- Table structure for pasa_role
-- ----------------------------
DROP TABLE IF EXISTS `pasa_role`;
CREATE TABLE `pasa_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `role_name` varchar(155) NOT NULL COMMENT '角色名称',
  `rule` varchar(255) DEFAULT '' COMMENT '权限节点数据',
  `updated_at` varchar(255) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of pasa_role
-- ----------------------------
INSERT INTO `pasa_role` VALUES ('1', '超级管理员', '*', null, null, null);
INSERT INTO `pasa_role` VALUES ('2', '系统维护员', '1,2,3,4,5', '1552873772', null, null);
INSERT INTO `pasa_role` VALUES ('7', '测试1', '29,30,31,32,33', '1552812125', null, '1552812097');
