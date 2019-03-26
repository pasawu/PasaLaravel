@include('layout.top')
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>文章列表</h5>
        </div>
        <div class="ibox-content">
            <div class="form-group clearfix col-sm-1">
                @if(authCheck('admin/articles/add'))
                <a href="{{url('admin/articles/add')}}">
                    <button class="btn btn-outline btn-primary" type="button">添加文章</button>
                </a>
                @endif
            </div>
            <!--搜索框开始-->
            <form id='commentForm' articles="form" method="post" class="form-inline pull-right">
                <div class="content clearfix m-b">
                    <div class="form-group">
                        <label>文章名称：</label>
                        <input type="text" class="form-control" id="keyword" name="keyword">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="button" style="margin-top:5px" id="search"><strong>搜
                                索</strong>
                        </button>
                    </div>
                </div>
            </form>
            <!--搜索框结束-->
            <div class="example-wrap">
                <div class="example">
                    <table id="cusTable">
                        <thead>
                        <th data-field="id">ID</th>
                        <th data-field="title">文章标题</th>
                        <th data-field="description">文章描述</th>
                        <th data-field="image">文章缩略图</th>
                        <th data-field="operate">操作</th>
                        </thead>
                    </table>
                </div>
                {{ csrf_field() }}
            </div>
            <!-- End Example Pagination -->
        </div>
    </div>
</div>
<!-- End Panel Other -->
@extends('layout.js')

<script src="{{asset('/static/admin/js')}}/jquery.min.js?v=2.1.4"></script>

<script type="text/javascript">
    function initTable() {
        //先销毁表格
        $('#cusTable').bootstrapTable('destroy');
        //初始化表格,动态从服务器加载数据
        $("#cusTable").bootstrapTable({
            method: "post",  //使用get请求到服务器获取数据
            url: "./index", //获取数据的地址
            striped: true,  //表格显示条纹
            pagination: true, //启动分页
            pageSize: 10,  //每页显示的记录数
            pageNumber: 1, //当前第几页
            pageList: [5, 10, 15, 20, 25],  //记录数可选列表
            sidePagination: "server", //表示服务端请求
            paginationFirstText: "首页",
            paginationPreText: "上一页",
            paginationNextText: "下一页",
            paginationLastText: "尾页",
            queryParamsType: "undefined",
            queryParams: function queryParams(params) {   //设置查询参数
                var param = {
                    _token: $("input[name='_token']").val(),
                    pageNumber: params.pageNumber,
                    pageSize: params.pageSize,
                    keyword: $('#keyword').val()
                };
                return param;
            },
            onLoadSuccess: function (res) {  //加载成功时执行
                if (1 == res.code) {
                    window.location.reload();
                }
                layer.msg("加载成功", {time: 1000});
            },
            onLoadError: function () {  //加载失败时执行
                layer.msg("加载数据失败");
            }
        });
    }

    $(document).ready(function () {
        //调用函数，初始化表格
        initTable();

        //当点击查询按钮的时候执行
        $("#search").bind("click", initTable);
    });

    function del(id) {
        layer.confirm('确认删除此文章?', {icon: 3, title: '提示'}, function (index) {
            //do something
            $.getJSON("{{url('admin/articles/delete')}}"+'/'+id, function (res) {
                if (1 == res.code) {
                    layer.alert(res.msg, {title: '友情提示', icon: 1, closeBtn: 0}, function () {
                        initTable();
                    });
                } else if (111 == res.code) {
                    window.location.reload();
                } else {
                    layer.alert(res.msg, {title: '友情提示', icon: 2});
                }
            });

            layer.close(index);
        })

    }
</script>
</body>
</html>
