<?php
/**
 * Created by PhpStorm.
 * User: Pasa吴
 * Date: 2019/3/15
 * Time: 14:11
 */

define('SUCCESS', 1); // 成功
define('FAILED', 0); // 失败

define('MES_SUCCESS', '操作成功'); // 成功
define('MES_FAILED', '网络失败'); // 失败
/**
 * 生成操作按钮
 * @param array $operate 操作按钮数组
 */
function showOperate($operate = [])
{
    if (empty($operate)) {
        return '';
    }

    $option = '';
    foreach ($operate as $key => $vo) {
        if (authCheck($vo['auth'])) {
            $option .= ' <a href="' . $vo['href'] . '"><button type="button" class="btn btn-' . $vo['btnStyle'] . ' btn-sm">' .
                '<i class="' . $vo['icon'] . '"></i> ' . $key . '</button></a>';
        }
    }

    return $option;
}

/**
 * 权限检测
 * @param $rule
 */
function authCheck($rule)
{
    $control = explode('/', $rule)['1'];

    if (in_array($control, ['login', 'index'])) {
        return true;
    }
    if (!is_array(session('rule'))) {
        if (session('rule') == '*') {
            return true;
        }
    }
    if (empty(session('rule'))) {
        return false;
    }
    $_rule = session('rule');
    if (!is_array($_rule)) {
        $_rule = explode(',', $_rule);
    }
    $rule = explode('/', $rule)['1'] . "/" . explode('/', $rule)['2'];
    if (in_array($rule, Cache::get(session('role_id')))) {
        return true;
    }

    return false;
}

/**
 * 整理菜单住方法
 * @param $param
 * @return array
 */
function prepareMenu($param)
{
    $param  = objToArray($param);
    $parent = []; //父类
    $child  = [];  //子类

    foreach ($param as $key => $vo) {

        if (0 == $vo['type_id']) {
            $vo['href'] = '#';
            $parent[]   = $vo;
        } else {
            $vo['href'] = url('admin/' . $vo['control_name'] . '/' . $vo['action_name']); //跳转地址
            $child[]    = $vo;
        }
    }

    foreach ($parent as $key => $vo) {
        foreach ($child as $k => $v) {

            if ($v['type_id'] == $vo['id']) {
                $parent[$key]['child'][] = $v;
            }
        }
    }
    unset($child);

    return $parent;
}

/**
 * 对象转换成数组
 * @param $obj
 */
function objToArray($obj)
{
    return json_decode(json_encode($obj), true);
}

/**
 * 整理出tree数据 ---  layui tree
 * @param $pInfo
 * @param $spread
 */
function getTree($pInfo, $spread = true)
{

    $res  = [];
    $tree = [];
    //整理数组
    foreach ($pInfo as $key => $vo) {

        if ($spread) {
            $vo['spread'] = true;  //默认展开
        }
        $res[$vo['id']]             = $vo;
        $res[$vo['id']]['children'] = [];
    }
    unset($pInfo);

    //查找子孙
    foreach ($res as $key => $vo) {
        if (0 != $vo['pid']) {
            $res[$vo['pid']]['children'][] = &$res[$key];
        }
    }

    //过滤杂质
    foreach ($res as $key => $vo) {
        if (0 == $vo['pid']) {
            $tree[] = $vo;
        }
    }
    unset($res);

    return $tree;
}

/**
 *  编辑器内容
 * @param int $id 编辑器id名称，与name同名
 * @param string $value 编辑器内容
 * @param string $type 编辑器工具栏
 * @param string $height 编辑器高度
 */
function showEditor($id, $value = '', $type = 'default', $height = "300px")
{
    echo '<div id="div" height="200px;">' . $value . '</div><textarea style="display:none;" id="' . $id . '"  name="' . $id . '" style="width:100%; height:200px;"></textarea>';
    echo '<script type="text/javascript" src="/static/wangEditor-3.1.1/release/wangEditor.js"></script>
    <script>
        var E = window.wangEditor;
        var editor  = new E("#div");
        var $text1  = $("#' . $id . '");
        var type    = "' . $type . '";
        editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $text1.val(html)
        }
        //自定义高度设置 - By  DIY
        editor.customConfig.height= "' . $height . '";
        // 配置服务器端地址
        editor.customConfig.uploadFileName = "file";
        editor.customConfig.uploadImgServer = "/admin/profile/wangEditorUpload";
        // 自定义菜单配置
        if(type == "simple"){
            editor.customConfig.menus = [
                "head",
                "bold",
                "italic",
                "underline",
                "foreColor",
                "code",
                "quote",
                "code"
            ];
        }
        editor.create();
        // 初始化 textarea 的值
        $text1.val(editor.txt.html())
</script>';
}