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
</script>