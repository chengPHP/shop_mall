{{--菜单栏--}}
{{--<li class="active">--}}
<li class="{{ active_class(if_uri_pattern('admin/home')) }}">
    <a href="{{url('admin/home')}}"><i class="fa fa-desktop"></i> <span class="nav-label">控制面板</span></a>
</li>

<li class="{{ active_class(if_uri_pattern('admin/user*')) }}">
    <a href="{{url('admin/user')}}"><i class="fa fa-address-card-o"></i> <span class="nav-label">后台用户管理</span></a>
</li>
<li class="{{ active_class(if_uri_pattern('admin/category*')) }}">
    <a href="{{url('admin/category')}}"><i class="fa fa-puzzle-piece"></i> <span class="nav-label">商品类别管理</span></a>
</li>

<li class="{{ active_class(if_uri_pattern('admin/brand*')) }}">
    <a href="{{url('admin/brand')}}"><i class="fa fa-puzzle-piece"></i> <span class="nav-label">品牌管理</span></a>
</li>

<li class="{{ active_class(if_uri_pattern('admin/rank*')) }}">
    <a href="{{url('admin/rank')}}"><i class="fa fa-puzzle-piece"></i> <span class="nav-label">会员等级管理</span></a>
</li>

<li class="{{ active_class(if_uri_pattern('admin/member*')) }}">
    <a href="{{url('admin/member')}}"><i class="fa fa-puzzle-piece"></i> <span class="nav-label">会员管理</span></a>
</li>

<li class="{{ active_class(if_uri_pattern('admin/region*')) }}">
    <a href="{{url('admin/region')}}"><i class="fa fa-puzzle-piece"></i> <span class="nav-label">城市管理</span></a>
</li>

<li class="{{ active_class(if_uri_pattern('admin/color*')) }}">
    <a href="{{url('admin/color')}}"><i class="fa fa-puzzle-piece"></i> <span class="nav-label">颜色管理</span></a>
</li>

<li class="{{ active_class(if_uri_pattern('admin/good*')) }}">
    <a href="{{url('admin/good')}}"><i class="fa fa-puzzle-piece"></i> <span class="nav-label">商品管理</span></a>
</li>

{{--<li class="{{ active_class(if_uri_pattern('admin/article*')) }}">
    <a href="{{url('admin/article')}}"><i class="fa fa-folder-open"></i> <span class="nav-label">文章管理</span> <span
                class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li class="{{ active_class(if_uri('admin/article')) }}">
            <a href="{{url('admin/article')}}"><i class="fa fa-envelope"></i> <span class="nav-label">文章管理</span></a>
        </li>
        <li class="{{ active_class(if_uri('admin/article/create')) }}">
            <a href="{{url('admin/article/create')}}"><i class="fa fa-pencil"></i> <span class="nav-label">添加文章</span></a>
        </li>
    </ul>
</li>--}}