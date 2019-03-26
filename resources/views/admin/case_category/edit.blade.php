@include('layout.top')

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑案例分类</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="commentForm" method="post" action="{{url('admin/case_category/edit',['id'=>$data['id']])}}">
                        <input type="hidden" name="id" value="{{$data['id']}}">


                        <div class="form-group">
                            <label class="col-sm-3 control-label">案例分类名称</label>
                            <div class="input-group col-sm-7">
                                <input type="text" class="form-control" value="{{$data['name']}}" name="name" required=""
                                       aria-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">题目类型：</label>
                            <div class="input-group col-sm-7">
                                <select id="type_id" name="parentid" class="form-control" required=""
                                        aria-required="true">
                                    <option value="0">一级分类</option>
                                    @foreach ($categoryList as $vo)
                                        <option value="{{$vo['id']}}" @if($vo['id']==$data['parentid']) selected="selected" @endif>{{$vo['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">分类图片：</label>
                            <input name="thumb" id="image" type="hidden" value="{{$data['thumb']}}"/>
                            <div class="form-inline">
                                <div class="input-group col-sm-2">
                                    <button type="button" class="layui-btn" id="upload">
                                        <i class="layui-icon">&#xe67c;</i>上传图片
                                    </button>
                                </div>
                                <div class="input-group col-sm-3">
                                    <div id="sm">
                                        <a target="_blank" href="{{$data['thumb']}}"><img src="{{$data['thumb']}}" width="40px" height="40px"/></a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">排序</label>
                            <div class="input-group col-sm-7">
                                <input type="number" class="form-control" value="{{$data['displayorder']}}" name="displayorder" required=""
                                       aria-required="true">
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
</body>
</html>
