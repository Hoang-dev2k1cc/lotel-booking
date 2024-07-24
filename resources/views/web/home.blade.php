@extends('layouts.master')
@section('content')
<head>
    <style>
    </style>
</head>
    <div class="main">
        <div class="content">
            <div class="view-content">
                <div class="item-list block-hot-hotel">
                    <ul class="list-unstyled row row-cols-4 row-cols-md-3 g-4">
                        @foreach ($data as $lot)
                            <li class="col">
                                <div class="views-field views-field-nothing"><span class="field-content">
                                        <div class="card shadow-sm">
                                            <a href="" hreflang="vi"><img
                                                    src="{{ asset('uploads/thumbs/' . $lot->thumb) }}" alt=""
                                                    loading="lazy" typeof="Image" class="image-style-large" />
                                            </a>
                                            <div class="card-body">
                                                <h4 class="card-title text-truncate">
                                                   @if (isset($checkin))
                                                   <a
                                                   href="{{ route('lotelDetailFillter', ['id' => $lot->id,
                                                                                    'checkin'=>$checkin,
                                                                                    'checkout'=>$checkout,]) }}"
                                                   hreflang="vi">{{ $lot->lotel_name }}</a>
                                                   @else
                                                   <a
                                                   href="{{ route('lotelDetail', ['id' => $lot->id]) }}"
                                                   hreflang="vi">{{ $lot->lotel_name }}</a>
                                                   @endif </h4>
                                                <p class="card-text">
                                                <div class="text-truncate">Địa chỉ :{{ $lot->address}},{{$lot->name_commune}},{{$lot->name_district}},{{$lot->name_province }}</div>

                                                <div class="text-muted text-truncate">Loại hình: <a
                                                        href="{{ route('typeLotel', ['type' => $lot->id_category,
                                                                                      'id' => $lot->id      ]) }}"
                                                        hreflang="vi">{{ $lot->name_category }}</a></div>
                                                        <div class="text-truncate">Giá từ :{{ $lot->price_day}} &#8363;</div>
                                                </p>
                                            </div>
                                        </div>
                                    </span></div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="pagination">
            {{$data->appends(request()->all())->links()}}
        </div>
    </div>
    <div class="news">
        <div class="content">
            <div class="d-flex justify-content-between" style="margin-bottom: -2rem">
                <h5 class="text-lotel">Tin Tức</h5>
                <h6 class="text-lotel"><a href="{{ route('news') }}">Xem thêm<i class="bi bi-arrow-right ms-2"></i></a>
                </h6>
            </div>
        </div>
    </div>
    <div class="row g-0">
        <div class="youtube-news col-4">
            <p><iframe class="youtube" src="https://www.youtube.com/embed/CxOouFQj3NE" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen=""></iframe></p>
        </div>
        <div class="news-content col-8">
            <ul class="ps-0">
                @foreach ($news as $new)
                    <li class="grid-item-gallery">
                        <div class="card shadow-sm">
                            <img src="{{ asset('uploads/news/' . $new->image) }}" alt="" loading="lazy"
                                typeof="Image">
                            <div class="p-content-bog">
                                <a href="{{route('newsDetail',['id'=>$new->id])}}">{{ $new->name }}</a>
                                <p>{!!$new->introduct!!}</p>
                            </div>
                        </div>
                    </li>
                @endforeach


            </ul>
        </div>
    </div>
    <div id="handbook" class="handbook ">
        <div id="content" class="content" style="position:relative">
            <div class="d-flex justify-content-between" style="margin-bottom: -2rem">
                <h5 class="text-lotel">Cẩm nang</h5>
                <h6 class="text-lotel"><a href="{{ route('handbook') }}">Xem thêm<i class="bi bi-arrow-right ms-2"></i></a>
                </h6>
            </div>
        </div><br>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <ul class="handbook-content">
                        @foreach ($handbook as $hand)
                            <li class="">
                                <a href="">
                                    <img src="{{ asset('uploads/handbooks/' . $hand->image) }}" alt="n" loading="lazy"
                                        typeof="Image">
                                    <h5 class="text-truncate">
                                        <div class="p-content-book">
                                            <a href="{{route('handbookDetail',['id'=>$hand->id])}}">{{ $hand->name }}</a>
                                        </div>
                                    </h5>

                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: black;"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: black;"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="view-header">
        <div class="d-flex justify-content-between">
            <h4>Điểm đến phổ biến</h4>
        </div>
    </div>
    <div class="view-popular">
        <ul class="list-popular d-flex">
            @foreach ($location as $loc)
                <li class="list-popular-item">
                    <a href="{{$loc->link}}">
                        <h5 class="p-2 title-news-list">
                            {{ $loc->name }}
                            <img src="../public/template/img/Asset11.png">
                        </h5>
                        <img src="../public/uploads/locations/{{ $loc->image }}" alt="" loading="lazy"
                            typeof="Image" />
                    </a>
                    <a href="/danh-sach-khach-san/ha-noi">
                    </a>
                </li>
            @endforeach

        </ul>
    </div>


@stop
