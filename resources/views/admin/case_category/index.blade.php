@include('layout.top')
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>案例分类列表</h5>
        </div>
        <div class="ibox-content">
            <div class="form-group clearfix col-sm-1">
                @if(authCheck('admin/case_category/add'))
                    <a href="{{url('admin/case_category/add')}}">
                        <button class="btn btn-outline btn-primary" type="button">添加案例分类</button>
                    </a>
                @endif
            </div>
            <!--搜索框开始-->
            <form action="{{url('admin/case_category/index')}}" case_category="form" method="get"
                  class="form-inline pull-right">
                <div class="content clearfix m-b">
                    <div class="form-group">
                        <label>案例分类名称：</label>
                        <input type="text" class="form-control" value="{{$param['keyword']}}" name="keyword">
                    </div>
                    <div class="form-group">
                        <div class="layui-inline">
                            <button class="btn btn-primary" style="margin-top:5px">搜索</button>
                        </div>
                    </div>
                </div>
            </form>
            <!--搜索框结束-->
            <div class="ibox-content">
                <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>分类名称</th>
                        <th>分类图片</th>
                        <th>排序</th>
                        <th>分类等级</th>
                        <th>时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($list as $vo)
                        <tr>
                            <td>{{$vo['id']}}</td>
                            <td>{{$vo['name']}}</td>
                            <td><a href="{{$vo['thumb']}}" target="_blank" style="color: red;text-decoration:underline"><img
                                            style="width: 80px;" src="{{$vo['thumb']}}"></a></td>
                            <td>{{$vo['displayorder']}}</td>
                            <td>{{$vo['level']}}</td>
                            <td>{{$vo['created_at']}}</td>
                            <td>
                                <a href="{{url('admin/case_category/edit',['id'=>$vo['id']])}}"
                                   class="btn btn-primary  btn-sm">编辑</a>
                                <a href="{{url('admin/case_category/delete',['id'=>$vo['id']])}}"
                                   class="btn btn-danger  btn-sm ajax-delete">删除</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {{ $list->appends(Request::all())->links() }}
            </div>
            <!-- End Example Pagination -->
        </div>
    </div>
</div>

@extends('layout.admin')
@extends('layout.js')
<script src="{{asset('/static/admin/js')}}/plugins/validate/jquery.validate.min.js"></script>
</body>
</html>
