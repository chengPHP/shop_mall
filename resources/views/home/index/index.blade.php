@extends('layouts.home')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>商城前台</h2>
            {!! Breadcrumbs::render('brand'); !!}
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            @foreach($good_list as $k=>$v)
                <div class="col-lg-3">
                    <div class="contact-box center-version">
                        <a href="{{url('good/'.$v['id'])}}">
                            <img alt="image" src="{{asset($v->files[0]['path'])}}" class="img-circle" style="height: 140px;width: 140px;">
                            <h3 class="m-b-xs"><strong>{{$v['name']}}</strong></h3>
                            <div class="font-bold">{{$v['shop_price']}} 元起</div>
                            <address class="m-t-md">
                                {{$v['brief']}}
                            </address>
                        </a>
                        <div class="contact-box-footer">
                            <div class="m-t-xs btn-group">
                                <a class="btn btn-md btn-white"><i class="fa fa-shopping-cart"></i> 购物车 </a>
                                {{--<a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>--}}
                                <a class="btn btn-md btn-white"><i class="fa fa-tag"></i> 立即购买</a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

            {{--<div class="col-lg-3">
                <div class="contact-box center-version">

                    <a href="profile.html">

                        <img alt="image" class="img-circle" src="img/a1.jpg">


                        <h3 class="m-b-xs"><strong>Alex Johnatan</strong></h3>

                        <div class="font-bold">CEO</div>
                        <address class="m-t-md">
                            <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>

                    </a>
                    <div class="contact-box-footer">
                        <div class="m-t-xs btn-group">
                            <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                            <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                            <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                        </div>
                    </div>

                </div>
            </div>--}}
        </div>
    </div>

@endsection