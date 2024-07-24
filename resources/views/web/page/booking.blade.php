<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <!-- Latest compiled and minified CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
        <link rel="stylesheet" href="{{ asset('template/css/filter.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/detail-hotel.css') }}">
    <link rel="stylesheet" href="{{ asset('template/libries/fontawesome-free-6.4.0-web/css/all.css') }}">

<style>
    .carousel-item img{
        width:641px;
        height:343px;
    }
    .b-filter{
        position: relative;
    top: -54px !important;
    }
</style>
</head>

<body>
    <div class="container">
        @include('layouts.header')
    </div>
    @if (Session::has('error'))
        <div class="alert alert-danger">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('error') }}
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="container">
        <div class="nav">
            <div class="title-booking">
                <h1>Xác nhận đặt phòng</h1>
            </div>
            <div class="row">
                <div class="col-7">
                    <div class="card-booking">

                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{asset('uploads/rooms/'.$room->image)}}"  >
                                </div>
                                @foreach (explode('|', $room->image_list) as $item)
                                <div class="carousel-item">
                                    <img src="{{asset('uploads/rooms/'.$item)}}" class="room-item" >
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true" style="top: -173px;
                                position: absolute;"></span>
                                <span class="visually-hidden">Previous</span>
                              </button>
                              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true" style="top: -139px;
                                left: 6px;
                                position: absolute;"></span>
                                <span class="visually-hidden">Next</span>
                              </button>
                        </div>
                        <div class="name-booking">
                            <h5>Tên Phòng : {{ $room->room_name }}</h5>
                        </div>
                        <div class="name-booking">
                            <h5>Mã Phòng : {{ $room->room_number }}</h5>
                        </div>
                        <div class="price-booking">
                            <h5>Giá : {{ $room->price }} &#8363;</h5>
                        </div>


                    </div>
                </div>
                <div class="col-5">


                    <form class="form-booking" action="{{ route('bookingStore', ['id' => $room->id]) }}" method="POST" id="form-booking">
                        @csrf
                        <div>
                            <h5>Chi tiết phòng đặt</h5>
                        </div>
                        <div class="form-group inlined">
                            <label for="name">Họ và tên</label>
                            <input type="text" name="username" value="{{ Auth::user()->name }}" class="form-control"
                                required>
                        </div>

                        <div class="form-group inlined">
                            <label for="name">Số điện thoại</label>
                            <input type="text" id="name" name="userphone" value="{{ Auth::user()->phone }}"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" id="name" name="useremail" value="{{ Auth::user()->email }}"
                                class="form-control" required>
                        </div>
                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="id_lotel" value="{{ $room->id_lotel }}">
                        <input type="hidden" name="id_room" value="{{ $room->id }}">
                        <input type="hidden" name="status" value="0">
                        <input type="hidden" name="code" value="ORD_">
                        <hr>
                        <div class="form-group inlined">
                            <label for="checkout-date">Ngày nhận phòng</label>
                            <input class="form-control" type="date" id="checkin-date" name="checkin" required>
                        </div>
                        <div class="form-group inlined">
                            <label for="checkout-date">Ngày trả phòng</label>
                            <input class="form-control" type="date" id="checkout-date" name="checkout" required
                                onchange="meFunction()">

                        </div>
                        <label id="nocations" style="color:tomato"></label>
                        <label id="time" ></label>
                        <label id="prices" ></label>
                        <input id="times" type="hidden" name="sum_time">

                        <input id="prices_sum" type="hidden" name="sum_price">

                        <hr>
                        <button onclick="return confirm('Bạn có chắc muốn đặt phòng này không?')" id="btnBooking" class="b-booking" type="submit">Xác nhận</button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</body>


</html>
@include('layouts.footer')
<script>
 var currentDateTime = new Date();
    var year = currentDateTime.getFullYear();
    var month = (currentDateTime.getMonth() + 1);
    var date = (currentDateTime.getDate());

    if (date < 10) {
        date = '0' + date;
    }
    if (month < 10) {
        month = '0' + month;
    }

    var dateTomorrow = year + "-" + month + "-" + date;
    var checkinElem = document.querySelector("#checkin-date");
    var checkoutElem = document.querySelector("#checkout-date");

    checkinElem.setAttribute("min", dateTomorrow);

    checkinElem.onchange = function() {
        checkoutElem.setAttribute("min", this.value);
    }
</script>
    <script>
    function meFunction() {
        var a = document.getElementById("checkin-date").value
        var b = document.getElementById("checkout-date").value
        var time = document.getElementById("time")
        var times = document.getElementById("times")
        var price = document.getElementById("price")
        var timestapin = new Date(a).getTime()
        var timestapout = new Date(b).getTime()

        if (timestapin == timestapout) {
            nocations.innerHTML = " Bạn không thể đặt và trả phòng trong cùng một ngày "
        } else {
            var result = (timestapout - timestapin) / 3600000 / 24
            document.getElementById("times").value = result
            document.getElementById("prices_sum").value = result * {{ $room->price }}

            time.innerHTML = "Số ngày : " + result

            prices.innerHTML = "Tổng tiền : " + result * {{ $room->price }} + "&#8363;"
        }
    }

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
