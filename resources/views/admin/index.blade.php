@extends('layouts.admin')

@section('content')
    <script src="{{asset('admin/js/plugins/echart/echarts.js')}}" ></script>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>商城后台</h2>
            {!! Breadcrumbs::render('admin/home'); !!}
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content text-center p-md">
                        <h2><span class="text-navy">商城后台</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
