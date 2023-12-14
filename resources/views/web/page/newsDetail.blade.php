@extends('layouts.master')
@section('content')
<head>
    <link rel="stylesheet" href="{{asset('template/css/newsdetail.css')}}">
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
    left:-120px !important;

}
    </style>
</head>
<div class="row">
    <div class="col-9 news-left">
        <h2>    {{$data->name}}</h2>
        {!! $data->content !!}
    </div>
    <div class="col-3 news-right">
        <h3>Bài viết khác</h3>
        <div class="item-news">
            <ul>
                @foreach ($news as $new )
                <li>
                    <div class="other_news">
                        <div class="other_news_img">
                            <img src="{{asset('uploads/news/'. $new->image)}}" >
                        </div>
                        <div class="other_news_title">
                            <a href="{{route('newsDetail',['id'=>$new->id])}}">{{$new->name}}</a>
                        </div>
                    </div>
                </li>
                @endforeach

            </ul>
        </div>
    </div>
</div>
@stop()



