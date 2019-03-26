<script type="text/javascript">
    // 上传图片
    layui.use('upload', function(){
        var upload = layui.upload;

        //执行实例
        var uploadInst = upload.render({
            elem: '#upload' //绑定元素
            ,url: "{{url('admin/profile/upload')}}" //上传接口
            ,done: function(res){
                //上传完毕回调
                $("#image").val(res.data.src);
                $("#sm").html('<a target="_blank" href="' + res.data.src + '"><img src="' + res.data.src + '" width="40px" height="40px"/></a>');
            }
            ,error: function(){
                //请求异常回调
            }
        });
    });
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
        $(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",});

        // 编辑案例分类
        var options = {
            beforeSubmit:showStart,
            success:showSuccess
        };

        $('#commentForm').submit(function(){
            $(this).ajaxSubmit(options);
            return false;
        });
    });

    /**
     * 通用删除
     */
    $('.ajax-delete').on('click', function () {
        var _href = $(this).attr('href');
        layer.open({
            shade: false,
            content: '确定删除？',
            btn: ['确定', '取消'],
            yes: function (index) {
                $.ajax({
                    url: _href,
                    type: "get",
                    success: function (info) {
                        if (info.code === 1) {
                            layer.alert(info.msg, {title: '友情提示', icon: 1, closeBtn: 0}, function(){
                                window.location.href = info.data;
                            });
                        } else {
                            layer.msg(res.msg, {anim: 6});
                        }
                    }
                });
                layer.close(index);
            }
        });
        return false;
    });
</script>