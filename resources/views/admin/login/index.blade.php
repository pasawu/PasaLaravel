@extends('layout.top')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>PasaLaravel后台登录</title>
    <link href="{{asset('/static/admin/css')}}/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('/static/admin/css')}}/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="{{asset('/static/admin/css')}}/animate.min.css" rel="stylesheet">
    <link href="{{asset('/static/admin/css')}}/style.min.css" rel="stylesheet">
    <link href="{{asset('/static/admin/css')}}/login.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if(window.top!==window.self){window.top.location=window.location};
    </script>

</head>

<body class="signin">
<div class="signinpanel">
    <div class="row">
        <div class="col-sm-7">
            <div class="signin-info">
                <div class="logopanel m-b">
                </div>
                <div class="m-b"></div>
                <h4>欢迎使用 <strong>PasaLaravel</strong></h4>
                <ul class="m-b">

                </ul>
            </div>
        </div>
        <div class="col-sm-5">
            <form method="post" action="index.html">
                <p class="m-t-md" id="err_msg">登录到PasaLaravel后台</p>
                <input type="text" class="form-control uname" placeholder="用户名" id="user_name" />
                <input type="password" class="form-control pword m-b" placeholder="密码" id="password" />
                <div style="margin-bottom:70px">
                    <input type="text" class="form-control" placeholder="验证码" style="color:black;width:120px;float:left;margin:0px 0px;" name="code" id="code"/>
                    <img  id="verify" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码" style="float:right;cursor: pointer" width="110px;" height="34"/>
                </div>
                <input class="btn btn-success btn-block" id="login_btn" value="登录"/>
            </form>
        </div>
    </div>
    <div class="signup-footer">
        <div class="pull-left">
            &copy; 2019 All Rights Reserved. PasaLaravel
        </div>
    </div>
    {{ csrf_field() }}

</div>
<script src="{{asset('/static/admin/js')}}/jquery.min.js?v=2.1.4"></script>
<script src="{{asset('/static/admin/js')}}/bootstrap.min.js?v=3.3.6"></script>
<script type="text/javascript">
    document.onkeydown=function(event){
        var e = event || window.event || arguments.callee.caller.arguments[0];
        if(e && e.keyCode==13){ // enter 键
            $('#login_btn').click();
        }
    };
    var lock = false;
    $(function () {
        $('#login_btn').click(function(){
            if(lock){
                return;
            }
            lock = true;
            $('#err_msg').hide();
            $('#login_btn').removeClass('btn-success').addClass('btn-danger').val('登陆中...');
            var username = $('#user_name').val();
            var password = $('#password').val();
            var code = $('#code').val();
            var _token = $("input[name='_token']").val();
            $.post("{{url('admin/login/login')}}",{'_token':_token,'user_name':username, 'password':password, 'captcha':code},function(data){
                lock = false;
                $('#login_btn').val('登录').removeClass('btn-danger').addClass('btn-success');
                if(data.code!=1){
                    $('#verify').attr('src', "{{ captcha_src('flat') }}' + '&_='+Math.random()");
                    $('#code').val('');
                    $('#err_msg').show().html("<span style='color:red'>"+data.msg+"</span>");
                    return;
                }else{
                    window.location.href=data.data;
                }
            });
        });
    });
</script>
</body>
</html>
