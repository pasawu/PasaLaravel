<!DOCTYPE html>
<html>
<head>
    <meta name="renderer" content="webkit">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html"/>
    <![endif]-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台管理</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{asset('/static/admin/css')}}/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="{{asset('/static/admin/css')}}/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="{{asset('/static/admin/css')}}/animate.min.css" rel="stylesheet">
    <link href="{{asset('/static/admin/css')}}/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{asset('/static/admin/css')}}/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="{{asset('/static/admin/css')}}/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="{{asset('/static/admin/css')}}/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="{{asset('/static/admin/js')}}/layui/css/layui.css"rel="stylesheet">
</head>
@yield('js')
<script type='text/javascript'>
    @if (count($errors) > 0)
    var errors = '';
    @foreach ($errors->all() as $error)
        errors += '{{ $error }} \n';
    @endforeach
    alert(errors);
    @endif
</script>
@yield('script')