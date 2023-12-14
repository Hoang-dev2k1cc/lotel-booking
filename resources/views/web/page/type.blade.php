<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>s
    <link rel="stylesheet" href="{{ asset('template/css/index.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('template/libries/fontawesome-free-6.4.0-web/css/all.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .colaps{
    top: 172px !important;
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
<div class="container">


    @include('layouts.header')

    <div class="text-align-center">
        @foreach ($name_type as $type)
            <h3>{{ $type->name_category }}</h3>
        @endforeach

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
                                                        src="{{ asset('uploads/thumbs/' . $lot->thumb) }}"
                                                        alt="" loading="lazy" typeof="Image"
                                                        class="image-style-large" />
                                                </a>
                                                <div class="card-body">
                                                    <h4 class="card-title text-truncate">
                                                        <a href="{{ route('lotelDetail', ['id' => $lot->id]) }}"
                                                            hreflang="vi">{{ $lot->lotel_name }}</a>
                                                    </h4>
                                                    <p class="card-text">
                                                    <div class="text-truncate">Địa chỉ
                                                        :{{ $lot->address }},{{ $lot->name_commune }},{{ $lot->name_district }},{{ $lot->name_province }}
                                                    </div>

                                                    <div class="text-muted text-truncate">Loại hình: <a
                                                            href="{{ route('typeLotel', ['type' => $lot->id_category]) }}"
                                                            hreflang="vi">{{ $lot->name_category }}</a></div>
                                                    <div class="text-truncate">Giá từ : {{ $lot->price_day }} &#8363;
                                                    </div>

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
        </div>
    </div>
    <div class="pagination">
        {{$data->appends(request()->all())->links()}}
    </div>
    <div class="view-header">
        <h3>Danh sách nhà nghỉ khách sạn gần đây</h3>
        <div class="view-content">
            <div class="list-inline">
                <ul class="list-inline">
                    <li>
                        <div class="item-list-near">
                            <a href=""><img src="{{ asset('template/img/1658798836_anhCong.jpg') }}"
                                    alt="" width="100%"></a>
                            <div class="item-list-near-content">
                                <a href="">Mercy Hotel</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-list-near">
                            <a href=""><img src="{{ asset('template/img/khach-san-the-king-1-10.jpg') }}"
                                    alt="" width="11.625rem" height="13.75rem"></a>
                            <div class="item-list-near-content">
                                <a href="">Khách sạn The King</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-list-near">
                            <a href=""><img src="{{ asset('template/img/emotel-10-ngo-huyen-10.jpg') }}"
                                    alt="" width="11.625rem" height="13.75rem"></a>
                            <div class="item-list-near-content">
                                <a href="">MHotel 10 ngõ Huyện
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-list-near">
                            <a href=""><img src="{{ asset('template/img/1650250693_anhPhong.jpg') }}"
                                    alt="" width="11.625rem" height="13.75rem"></a>
                            <div class="item-list-near-content">
                                <a href="">Khách sạn Gia Lợi
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-list-near">
                            <a href=""><img src="{{ asset('template/img/nha-nghi-tien-thinh-10.jpeg') }}"
                                    alt="" width="11.625rem" height="13.75rem"></a>
                            <div class="item-list-near-content">
                                <a href="">Nhà nghỉ Tiến Thịnh
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-list-near">
                            <a href=""><img src="{{ asset('template/img/a25-hotel-doi-can-1-10.jpg') }}"
                                    alt="" width="100%"></a>
                            <div class="item-list-near-content">
                                <a href="">Mercy Hotel</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-list-near">
                            <a href=""><img src="{{ asset('template/img/emotel-10-ngo-huyen-10.jpg') }}"
                                    alt="" width="100%"></a>
                            <div class="item-list-near-content">
                                <a href="">MHotel số 10 ngõ Huyện
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-list-near">
                            <a href=""><img src="{{ asset('template/img/hanoi-la-storia-hotel-10.jpg') }}"
                                    alt="" width="100%"></a>
                            <div class="item-list-near-content">
                                <a href="">Hanoi La Storia Hotel
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-list-near">
                            <a href=""><img src="{{ asset('template/img/1639643425_anhPhong.jpg') }}"
                                    alt="" width="100%"></a>
                            <div class="item-list-near-content">
                                <a href="">Ấm Êm - Homestay
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

</html>
