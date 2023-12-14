@extends('layouts.admin')
@section('main')
<head>
    <style>
#searchFormOrder{
    display:flex;
}
#searchFormOrder input{
    width:20%;
}
    </style>
</head>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Trang Quản Lý</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Lotel</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <form id="searchFormOrder" action="{{route('searchPay')}} " method="GET">
        <input  type="date" id="edit-name-city" name="start"
            maxlength="128" class="form-search form-control" />
            <input  type="date" id="edit-name-city" name="finish"
            maxlength="128" class="form-search form-control" />

            <input type="submit" id="submitFromSearch" value="Tìm kiếm">
    </form>
    <table class="table table-bordered">
        <thead class= "thead-dark">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Thông tin khách hàng</th>
                <th class="text-center">Thông tin phòng</th>
                <th class="text-center">Thời gian</th>
                <th class="text-center">Thao tác</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                @foreach ($data as $booking)
                <td class="text-center">{{ $booking->id }}</td>
                <td class="text-left">
                    <b>ID Đơn : </b>{{ $booking->code }}
                   <br> <b>Họ và tên : </b>{{ $booking->username }}
                    <br><b>Email : </b>{{ $booking->useremail }}
                    <br><b>Số điện thoại : </b>{{ $booking->userphone }}
                </td>
                    <td class="text-left">
                        <b>Tên phòng : </b>{{ $booking->room_name }}
                        <br><b>Mã số phòng : </b>{{ $booking->room_number }}
                        <br><b> Cơ sở : </b>{{ $booking->lotel_name }}
                        <br><b> Giá : </b>{{ $booking->price }} &#8363; / <b>Ngày</b>
                        <br><b> Tổng : </b>{{ $booking->sum_price }} &#8363;

                    </td>
                    <td class="text-left">
                        <b>Ngày đến :</b>{{ date('d/m/Y',strtotime ($booking->checkin)) }}
                        <br><b>Ngày trả :</b>{{ date('d/m/Y',strtotime ($booking->checkout)) }}
                        <br><b> Tổng thời gian : </b>{{ $booking->sum_time }} <b>Ngày</b>
                        <br><b> Ngày đặt : </b>{{ date('d/m/Y',strtotime ($booking->created_at)) }}

                    </td>


                    <td class="text-right">


                        <a
                            href="{{ route('bookingPayment', ['id' => $booking->id]) }}"class="btnPayment btn btn-sm btn-success">
                           Xác nhận Thanh toán
                        </a>
                        <a href="{{ route('bookingCancel',['id'=>$booking->id ]) }}"class="btnCancel btn btn-sm btn-danger">
                            Hủy đặt phòng
                         </a>

                        </div>

                    </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $data->links() }}
    </div>
    <form action="" method="GET" id="form-cancel">
        @csrf @method('UPDATE')
    </form>

    <form action="" method="GET" id="form-payment">
        @csrf @method('UPDATE')
    </form>
@stop
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".btnCancel").click(function() {
                event.preventDefault();
                var _href = $(this).attr('href');
                $('form#form-cancel').attr('action', _href);
                if (confirm('Bạn có chắc muốn hủy room này không?')) {
                    $('form#form-cancel').submit();
                }
            });
        });
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".btnPayment").click(function() {
                event.preventDefault();
                var _href = $(this).attr('href');
                $('form#form-payment').attr('action', _href);
                if (confirm('Bạn có chắc muốn xác nhận thanh toán room này không?')) {
                    $('form#form-payment').submit();
                }
            });
        });
    </script>

@stop
