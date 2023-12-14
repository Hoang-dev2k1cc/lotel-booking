@extends('layouts.master')
@section('content')
<head>
    <link rel="stylesheet" href="{{asset('template/css/handbookdetail.css')}}">
    <style>
 .colaps{
        top: 148px !important;
        height: 46px !important;
        left: 1117px !important;
        float: right !important;
        position: absolute !important;
        width: 44px !important;
    }
    .dropdown-menu{
    width:1115px !important;
    left:-121px !important;

}
    </style>
</head>
<div class="row">
    <div class="col-9 handboook-left">
        <h2>    {{$data->name}}</h2>
        {!! $data->content !!}
    </div>
    <div class="col-3 handboook-right">
        <h3>Bài viết khác</h3>
        <div class="item-hand">
            <ul>
                @foreach ($handbooks as $handbook )
                <li>
                    <div class="other_handbook">
                        <div class="other_handbook_img">
                            <img src="{{asset('uploads/handbooks/'. $handbook->image)}}" >
                        </div>
                        <div class="other_handbook_title">
                            <a href="">{{$handbook->name}}</a>
                        </div>
                    </div>
                </li>
                @endforeach

            </ul>
        </div>
    </div>
</div>
@stop()



