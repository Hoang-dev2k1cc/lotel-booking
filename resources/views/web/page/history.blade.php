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
    <link rel="stylesheet" href="{{ asset('template/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/history.css') }}">
    <link rel="stylesheet" href="{{ asset('template/libries/fontawesome-free-6.4.0-web/css/all.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="back">
    <div class="container">


        <div class="row header">
            <div class=" logo col-3">
                <a href="{{ route('home') }}"><img src="{{ asset('template/img/logo.svg') }}" alt=""></a>
            </div>
            <div class="col-4">
                <form id="searchForm" action="{{ route('search') }} " method="GET">
                    <input placeholder="Thành phố, vị trí" type="search" id="edit-name-city" name="key"
                        maxlength="128" class="form-search form-control" />

                    <input type="submit" id="submitFromSearch" value="Tìm kiếm">
                </form>
            </div>

            <div class="col-2">

            </div>
            <div class="col-2">
            </div>
            @if (Auth::check())
                <div class=" user col-1">
                    <div class="dropdown">
                        <img class="dropbtn" onclick="myFunction()"
                            src="{{ asset('uploads/users/' . Auth::user()->photo) }}">
                        <div id="myDropdown" class="dropdown-content">
                            <a href="{{ route('history', ['id' => Auth::user()->id]) }}">Lịch Sử</a>

                            <a href="{{ route('userInfor', ['id' => Auth::user()->id]) }}">Thông Tin</a>
                            <a href="{{ route('logout') }}">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            @else
                <div class=" user col-1">pay

                    <div class="dropdown">
                        <i class=" dropbtn fa-solid fa-user" aria-hidden="trues" onclick="myFunction()"></i>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="{{ route('showRegister') }}">Đăng Ký</a>
                            <a href="{{ route('show-form-login') }}">Đăng Nhập</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
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





        <!-- Small modal -->




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
        <div class="title-history">
            <h2 class="container">DANH SÁCH PHÒNG ĐÃ ĐẶT</h2>
        </div>

        <div class="row">
            <div class="history-booking">
                <ul>
                    @foreach ($data as $his)
                        <li>
                            <h6>Mã đơn : {{ $his->code }}</h6>
                            <div> <b>Tên phòng : </b>{{ $his->room_name }}</div>
                            <div> <b>Mã phòng : </b>{{ $his->room_number }}</div>
                            <div><b>Cơ sở :</b>{{ $his->lotel_name }}</div>
                            <div> <b>Giá:</b> {{ $his->price }} &#8363; / ngày</div>
                            <div><b>Tổng: </b>{{ $his->sum_price }} &#8363;</div>
                            <div><b>Ngày Vào: </b>{{date('d/m/Y',strtotime($his->checkin))  }}</div>
                            <div><b>Ngày Trả: </b> {{date('d/m/Y',strtotime( $his->checkout)) }}</div>

                            <div><b>Ngày Đặt :</b> {{date('d/m/Y',strtotime( $his->created_at)) }}</div>

                            @csrf
                            @if ($his->status == 0)
                                <a class="btn btn-warning">Đã Đặt</a>


                                <a
                                    href="{{ route('bookingCancel', ['id' => $his->id]) }}"class="btnCancel btn btn-primary">
                                    Hủy đặt phòng
                                </a>
                            @endif
                            @if ($his->status == 1)
                            <a href="{{route('stripe.indexPayment',['id'=>$his->id])}}" class="btn btn-success"
                                >Thanh toán onlnie</a>
                                <a class="btn btn-primary">Đã Xác nhận </a>
                            @endif
                            @if ($his->status == 4)
                            <a class="btn btn-primary">Bị từ chối </a>
                        @endif
                            @if ($his->status == 2)
                                <a class="btn btn-success">Đã thanh toán </a>
                            @endif
                            @if ($his->status == 3)
                                <a class="btn btn-danger">Đã Hủy </a>
                            @endif



                        </li>


                    @endforeach
                </ul>

            </div>
            <form action="" method="GET" id="form-cancel">
                @csrf @method('UPDATE')
            </form>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".btnCancel").click(function() {
            event.preventDefault();
            var _href = $(this).attr('href');
            $('form#form-cancel').attr('action', _href);
            if (confirm('Bạn có chắc muốn hủy đặt phòng này không?')) {
                $('form#form-cancel').submit();
            }
        });
    });
</script>
@include('layouts.footer')
