@include('layout.top')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改信息</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{asset('/static/admin/css')}}/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="{{asset('/static/admin/css')}}/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="{{asset('/static/admin/css')}}/animate.min.css" rel="stylesheet">
    <link href="{{asset('/static/admin/css')}}/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="{{asset('/static/admin/js')}}/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="{{asset('/static/admin/js')}}/layui/css/layui.css"rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-10">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>修改信息</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="commentForm" method="post" action="{{url('admin/profile/headedit')}}">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">真实姓名：</label>
                            <div class="input-group col-sm-7">
                                <input id="title" type="text" class="form-control" name="real_name" required="" aria-required="true" value="{{$data['real_name']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">登录密码：</label>
                            <div class="input-group col-sm-7">
                                <input id="password" type="text" class="form-control" name="password"  placeholder="如果要修改密码请输入密码，不修改不输入即可">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">缩略图：</label>
                            <input name="head" id="thumbnail" type="hidden" value="{{$data['head']}}"/>
                            <div class="form-inline">
                                <div class="input-group col-sm-2">
                                    <button type="button" class="layui-btn" id="test1">
                                        <i class="layui-icon">&#xe67c;</i>上传图片
                                    </button>
                                </div>
                                <div class="input-group col-sm-3">
                                    <div id="sm">
                                        <a target="_blank" href="{{$data['head']}}"><img src="{{$data['head']}}" width="40px" height="40px"/></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-8">
                                <button class="btn btn-primary" type="submit">确认提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="{{asset('/static/admin/js')}}/jquery.min.js?v=2.1.4"></script>
<script src="{{asset('/static/admin/js')}}/bootstrap.min.js?v=3.3.6"></script>
<script src="{{asset('/static/admin/js')}}/content.min.js?v=1.0.0"></script>
<script src="{{asset('/static/admin/js')}}/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="{{asset('/static/admin/js')}}/plugins/validate/jquery.validate.min.js"></script>
<script src="{{asset('/static/admin/js')}}/plugins/validate/messages_zh.min.js"></script>
<script src="{{asset('/static/admin/js')}}/layui/layui.js"></script>
<script src="{{asset('/static/admin/js')}}/jquery.form.js"></script>
<script src="{{asset('/static/admin/js')}}/plugins/ueditor/ueditor.config.js"></script>
<script src="{{asset('/static/admin/js')}}/plugins/ueditor/ueditor.all.js"></script>
<script type="text/javascript">

    var index = '';
    function showStart(){
        index = layer.load(0, {shade: false});
        return true;
    }

    function showSuccess(res){

        layer.ready(function(){
            layer.close(index);
            if(1 == res.code){
                layer.alert(res.msg, {title: '友情提示', icon: 1, closeBtn: 0}, function(){
                    window.location.href = res.data;
                });
            }else if(111 == res.code){
                window.location.reload();
            }else{
                layer.msg(res.msg, {anim: 6});
            }
        });
    }

    $(document).ready(function(){
        // 添加角色
        var options = {
            beforeSubmit:showStart,
            success:showSuccess
        };

        $('#commentForm').submit(function(){
            $(this).ajaxSubmit(options);
            return false;
        });

        $('#keywords').tagsinput('add', 'some tag');
        $(".bootstrap-tagsinput").addClass('col-sm-12').find('input').addClass('form-control')
            .attr('placeholder', '输入后按enter');

        // 上传图片
        layui.use('upload', function(){
            var upload = layui.upload;

            //执行实例
            var uploadInst = upload.render({
                elem: '#test1' //绑定元素
                ,url: "{{url('admin/profile/upload')}}" //上传接口
                ,done: function(res){
                    //上传完毕回调
                    $("#thumbnail").val(res.data.src);
                    // $("#sm").html('<img src="' + res.data.src + '" style="width:40px;height: 40px;"/>');
                    $("#sm").html('<a target="_blank" href="' + res.data.src + '"><img src="' + res.data.src + '" width="40px" height="40px"/></a>');
                }
                ,error: function(){
                    //请求异常回调
                }
            });
        });

        var editor = UE.getEditor('container');
    });

    // 表单验证
    $.validator.setDefaults({
        highlight: function(e) {
            $(e).closest(".form-group").removeClass("has-success").addClass("has-error")
        },
        success: function(e) {
            e.closest(".form-group").removeClass("has-error").addClass("has-success")
        },
        errorElement: "span",
        errorPlacement: function(e, r) {
            e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent())
        },
        errorClass: "help-block m-b-none",
        validClass: "help-block m-b-none"
    });
</script>
</body>
</html>
