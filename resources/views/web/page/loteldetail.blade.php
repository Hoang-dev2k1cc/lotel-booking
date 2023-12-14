<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        ul {
            list-style: none outside none;
            padding-left: 0;
            margin: 0;
        }

        .demo .item {
            margin-bottom: 60px;
        }

        .content-slider li {
            background-color: #ed3020;
            text-align: center;
            color: #FFF;
        }

        .content-slider h3 {
            margin: 0;
            padding: 70px 0;
        }

        .demo {
            width: 800px;
        }
.main-right{
    position: relative;
    top: 32px;

}
.colaps{
    top: 148px !important;
    height: 46px !important;
    left: 1117px !important;
    float: right !important;
    position: absolute !important;
    width: 44px !important;
}
    </style>
    <link rel="stylesheet" href="{{ asset('template/css/lightslider.css') }}" >
    <link rel="stylesheet" href="{{ asset('template/css/prettify.css') }}" >
    <link rel="stylesheet" href="{{ asset('template/css/detail-hotel.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/filter.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/index.css') }}">


    <link rel="stylesheet" href="{{ asset('template/libries/fontawesome-free-6.4.0-web/css/all.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>.colaps{
        top: 155px !important;
        height: 46px !important;
        left: 1117px !important;
        float: right !important;
        position: absolute !important;
        width: 44px !important;
    }
    .dropdown-menu{
    width:1115px !important;
    left:-120px !important;

}</style>

<body class="path-frontpage page-node-type-page d-flex flex-column h-100">
    <div class="container">

        <header>
            @include('layouts.header')
        </header>
        <div class="main-detail">
            @foreach ($data as $detail)
                <h1>{{ $detail->lotel_name }}</h1>
                <div class="row">
                    <div class="address col-8">
                        <a class="add" href="{{ $detail->located }}" target="_blank">
                            {{ $detail->address }},{{ $detail->name_commune }},{{ $detail->name_district }},{{ $detail->name_province }}
                        </a><i class="fa-solid fa-location-dot"></i>

                            <ul id="imageGallery">
                                @foreach (explode('|', $detail->image_list) as $item)
                                    <li data-thumb="{{ asset('uploads/details/' . $item) }}"
                                        data-src="{{ asset('uploads/details/' . $item) }}">
                                        <img class="big-img" src="{{ asset('uploads/details/' . $item) }}" height="50%" >
                                    </li>
                                @endforeach
                            </ul>



                    </div>
                    <div class="main-right col-4">

                        <form action="">
                            <div class="intro">
                                <h4>Giới thiệu cơ sở lưu trú</h4>
                                <p> {!! $detail->introduct !!}</p>
                            </div>
                            <h5>Số người tối đa :{{$detail->person}}</h5>
                            <h5>Giá từ :{{$detail->price_day}} &#8363;</h5>
                            <h5>Tiện ích</h5>
                            <div class="listComfortHotel">
                                {{$detail->equipment}}
                            </div>
                            <br>
                            <h5>Liên hệ</h5>
                            <p class="text-truncate" id="phoneHotel">
                                {{ $detail->contact }}
                            </p>
                            @if (isset($checkin))
                            <a href="{{ route('roomFillter', ['id' => $detail->id,
                                                         'checkin'=>$checkin,
                                                         'checkout'=>$checkout]) }}" class="btn btn-danger">Xem phòng
                                trống</a>
                            @else
                            <a href="{{ route('room', ['id' => $detail->id]) }}" class="btn btn-danger">Xem phòng
                                trống</a>
                            @endif


                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="view-header">
            <h3>Danh sách nhà nghỉ khách sạn gần đây</h3>
            <div class="view-content">
                <div class="item-list">
                    <ul class="list-inline">
                        @foreach ($same as $s )
                        <li>
                            <div class="list-inline-item">
                                <a href=""><img src="{{ asset('uploads/thumbs/'.$s->thumb) }}"
                                        alt="" width="100%"></a>
                                <div class="list-inline-item-content">
                                    <a href="{{route('lotelDetail',['id'=>$s->id])}}">{{$s->lotel_name}}</a>
                                </div>
                            </div>
                        </li>
                        @endforeach


                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>


</html>
<script>
    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="{{ asset('template/js/lightslider.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#imageGallery').lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            thumbItem: 9,
            slideMargin: 0,
            enableDrag: false,
            currentPagerPosition: 'left',
            onSliderLoad: function(el) {
                el.lightGallery({
                    selector: '#imageGallery .lslide'
                });
            }
        });
    });
</script>
