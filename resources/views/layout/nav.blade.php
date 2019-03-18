<div class="layui-header">
    <div class="itkee-logo">
        <p>9JM9.COM <span class="layui-badge layui-badge-rim layui-bg-orange">版本号：1.0.0</span></p>
        <p>后台管理系统 ©</p>
    </div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
        {foreach name="top_nav" item="vo"}
        <li class="layui-nav-item parent-id-{$vo.id}"><a class="itkee-nav" data-id="{$vo.id}">{$vo.title1}</a></li>
        {/foreach}
    </ul>
    <ul class="layui-nav layui-layout-right">

        <li class="layui-nav-item">
            <a class="child-a ajax-get" href="{:url('admin/Clear/delete')}">清理缓存</a>
        </li>

        <li class="layui-nav-item">
            {{ Auth::guard('admin')->user()->related_role()->first()->role_name }}
        </li>

        <li class="layui-nav-item">
            <a href="javascript:;">
                <i class="layui-icon layui-nav-img">&#xe612;</i> {{ Auth::guard('admin')->user()->username }}
            </a>
        </li>
        <li class="layui-nav-item"><a href="{{ url('admin/login/loginout') }}">退出</a></li>
    </ul>
</div>
<!--左侧菜单栏-->
<div class="itkee-left-nav">
    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree menu-left" id="menu-left-{$key}">
                @foreach ($list as $vo)
                <li class="layui-nav-item ">
                    <a class="" href="javascript:;"><i class="layui-icon">&#xe600;</i>{{$vo['auth_name']}}</a>

                    <dl class="layui-nav-child">
                        @if ($vo['child'])
                        @foreach ($vo['child'] as $vo)
                        <dd><a class="{if condition='($key==0)'}{/if}" data-type="tabAdd" data-menu-id="1" data-herf="{{$vo['url']}}">{{$vo['auth_name']}}</a></dd>
                        @endforeach
                        @endif
                    </dl>
                </li>
                @endforeach
            </ul>

        </div>
    </div>
</div>
<!--左侧菜单栏-->