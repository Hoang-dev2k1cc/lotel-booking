<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <link rel="stylesheet" href="{{ asset('template/css/room.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/index.css') }}">


    <link rel="stylesheet" href="{{ asset('template/libries/fontawesome-free-6.4.0-web/css/all.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .list-room{


position: relative;
left: 89px !important;


}
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
    left:-220px !important;

}
</style>
</head>

<body class="path-frontpage page-node-type-page d-flex flex-column h-100">

    <div class="container">
        @include('layouts.header')
    </div>
    <div class="text-align-center main-room">
        @foreach ($lotel as $lot)
            <h3>{{ $lot->lotel_name }}</h3>
        @endforeach

        <ul class="row list-room">
            @foreach ($data as $room)
                <li type="" class="card-room col-4">
                    <div class="thumb-room">


                        {{-- {{ dd(explode('|',$room->image)) }} --}}





                        @foreach (explode('|',$room->image) as $item)

                        <img src="{{ asset('uploads/rooms/' . $item ) }}" alt width="100̀̀%">
                        @endforeach

                    </div>
                    <div class="number-room">
                        <p><b>Mã phòng : {{ $room->room_number }}</b>
                        <p>
                    </div>
                    <div class="title-room">
                        <p><b>Tên phòng : </b> {{ $room->room_name }}</p>
                    </div>
                    <div class="price-room">
                        <p><b>Giá : </b> {{ $room->price }} &#8363; / Ngày</p>

                    </div>
                    <br>
                    <div class="person-room">
                        <p> <b>Người lớn : </b>{{ $room->adults }} </p>
                        <p> <b>Trẻ em : </b>{{ $room->childrens }} </p>
                    </div>
                    <div class="content-room">
                        <p> {!! $room->about !!}</p>
                    </div>
                    <div class="content-room">



                        <p> {{ $room->sevices }}</p>
                    </div>
                    <div class="book-room">
                        <a href="{{ route('booking', ['id' => $room->id]) }}" class=""> Đặt ngay</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    </div>
</body>
@include('layouts.footer')

</html>
