{{--前台 菜单栏--}}
{{--<li class="active">--}}
<li class="active">
    <a href="{{url('/')}}"><i class="fa fa-desktop"></i> <span class="nav-label">首页</span></a>
</li>

<li class="">
    <a href="javascript:;" onclick="to_login()" data-toggle="modal" data-target=".bs-example-modal-md">
        <i class="fa fa-desktop"></i> <span class="nav-label">登录</span>
    </a>
</li>

<li class="">
    <a href="{{url('to_register')}}"><i class="fa fa-desktop"></i> <span class="nav-label">注册</span></a>
</li>

@if(\Illuminate\Support\Facades\Session::get('member_id'))

    <li class="">
        <a href="{{route('/')}}"><i class="fa fa-folder-open"></i> <span class="nav-label">个人中心</span> <span
                    class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li class="">
                <a href="{{url('admin/article')}}"><i class="fa fa-envelope"></i> <span class="nav-label">订单中心</span></a>
            </li>
            <li class="">
                <a href="{{url('admin/article')}}"><i class="fa fa-envelope"></i> <span class="nav-label">我的购物车</span></a>
            </li>
            <li class="">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-pencil"></i> <span class="nav-label">收货地址</span></a>
            </li>
            <li class="">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-pencil"></i> <span class="nav-label">个人信息</span></a>
            </li>
        </ul>
    </li>
@endif