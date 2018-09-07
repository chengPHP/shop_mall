{{--菜单栏--}}
{{--<li class="active">--}}
<li class="{{ active_class(if_uri_pattern('admin/home')) }}">
    <a href="{{url('admin/home')}}"><i class="fa fa-desktop"></i> <span class="nav-label">控制面板</span></a>
</li>

<li class="{{ active_class(if_uri_pattern('admin/user*')) }}">
    <a href="{{url('admin/user')}}"><i class="fa fa-address-card-o"></i> <span class="nav-label">用户管理</span></a>
</li>
<li class="{{ active_class(if_uri_pattern('admin/category*')) }}">
    <a href="{{url('admin/category')}}"><i class="fa fa-puzzle-piece"></i> <span class="nav-label">类别管理</span></a>
</li>
<li class="{{ active_class(if_uri_pattern('admin/article*')) }}">
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
</li>
<li class="{{ active_class(if_uri_pattern('admin/nav*')) }}">
    <a href="{{url('admin/nav')}}"><i class="fa fa-bars"></i> <span class="nav-label">导航栏管理</span></a>
</li>
<li class="{{ active_class(if_uri_pattern('admin/diary*')) }}">
    <a href="{{url('admin/diary')}}"><i class="fa fa-pencil-square-o"></i> <span class="nav-label">个人日记管理</span>
        <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li class="{{ active_class(if_uri('admin/diary')) }}">
            <a href="{{url('admin/diary')}}"><i class="fa fa-book"></i><span class="nav-label">日记管理</span></a>
        </li>
        <li class="{{ active_class(if_uri('admin/diary/create')) }}"><a href="{{url('admin/diary/create')}}"><i
                            class="fa fa-pencil-square-o"></i> <span class="nav-label">记录日记</span></a></li>
    </ul>
</li>
<li class="{{ active_class(if_uri_pattern('admin/feedback*')) }}">
    <a href="{{url('admin/feedback')}}"><i class="fa fa-envelope"></i> <span class="nav-label">留言管理</span></a>
</li>
<li class="{{ active_class(if_uri_pattern('admin/link*')) }}">
    <a href="{{url('admin/link')}}"><i class="fa fa-link"></i> <span class="nav-label">推荐链接管理</span></a>
</li>
<li class="{{ active_class(if_uri_pattern('admin/role*')) }}">
    <a href="{{url('admin/role')}}"><i class="fa fa-desktop"></i> <span class="nav-label">角色管理</span></a>
</li>
<li class="{{ active_class(if_uri_pattern('admin/permission*')) }}">
    <a href="{{url('admin/permission')}}"><i class="fa fa-desktop"></i> <span class="nav-label">权限管理</span></a>
</li>