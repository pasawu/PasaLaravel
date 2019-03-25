@include('layout.top')
<script src="{{asset('/static/admin/js')}}/jquery.min.js?v=2.1.4"></script>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加文章</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="commentForm" method="post"
                          action="{{url('admin/articles/add')}}">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">文章标题</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="title" required=""
                                       aria-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">描述</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="description" required=""
                                       aria-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">缩略图：</label>
                            <input name="image" id="image" type="hidden" value=""/>
                            <div class="form-inline">
                                <div class="input-group col-sm-2">
                                    <button type="button" class="layui-btn" id="upload">
                                        <i class="layui-icon">&#xe67c;</i>上传图片
                                    </button>
                                </div>
                                <div class="input-group col-sm-3">
                                    <div id="sm">
                                        <a target="_blank" href=""><img src="" width="40px" height="40px"/></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="display: flex;align-items: center;">
                            <label class="col-sm-3 control-label">内容</label>
                            <div class="input-group col-sm-4">
                                <?php
                                showEditor("content");
                                ?>
                            </div>
                        </div>
                </div>
                {{ csrf_field() }}
                <div class="form-group">
                    <a class="btn btn-primary col-sm-1 col-sm-offset-3" href="javascript:history.go(-1)">返回</a>
                    <button class="btn btn-primary col-sm-1 col-sm-offset-2" type="submit">提交</button>
                </div>

                </form>
            </div>
        </div>

    </div>
</div>
</div>
@extends('layout.admin')
@extends('layout.js')
<script src="{{asset('/static/admin/js')}}/plugins/validate/jquery.validate.min.js"></script>

<script type="text/javascript">

    var index = '';

    function showStart() {
        index = layer.load(0, {shade: false});
        return true;
    }

    function showSuccess(res) {

        layer.ready(function () {
            layer.close(index);
            if (1 == res.code) {
                layer.alert(res.msg, {title: '友情提示', icon: 1, closeBtn: 0}, function () {
                    window.location.href = res.data;
                });
            } else if (111 == res.code) {
                window.location.reload();
            } else {
                layer.msg(res.msg, {anim: 6});
            }
        });
    }

    $(document).ready(function () {
        $(".i-checks").iCheck({checkboxClass: "icheckbox_square-green", radioClass: "iradio_square-green",});
        // 添加文章
        var options = {
            beforeSubmit: showStart,
            success: showSuccess
        };
        $('#commentForm').submit(function () {
            $(this).ajaxSubmit(options);
            return false;
        });
    });

    // 表单验证
    $.validator.setDefaults({
        highlight: function (e) {
            $(e).closest(".form-group").removeClass("has-success").addClass("has-error")
        },
        success: function (e) {
            e.closest(".form-group").removeClass("has-error").addClass("has-success")
        },
        errorElement: "span",
        errorPlacement: function (e, r) {
            e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent())
        },
        errorClass: "help-block m-b-none",
        validClass: "help-block m-b-none"
    });
</script>
</body>
</html>
