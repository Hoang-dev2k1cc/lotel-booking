!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <link rel="stylesheet" href="{{ asset('template/css/bill.css') }}">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .print{
    display:flex !important;
    font-family: "Times New Roman";
    margin-top:20px;
    margin-left: 10px;

}
.row{
    position:relative;
    left:21%;
}
b{
    font-size:20px;
}
.bill{
    border:1px solid #ddd;
    width:60%;

}
h1{
    text-align: center;
}
span, b{
   font-family: DejaVu Sans;
}
</style>
</head>

<body>
    <div class="row">
        <div class="bill">
            <h1>ORD_1700488409</h1>
            <form>
                @foreach($data as $his)
                <div class="print">
                    <b>Tên phòng : </b><span>{{$his->room_name}}</span>
                </div>
                <div class="print">
                    <b>Mã phòng : </b><span>{{$his->room_number}}</span>
                </div>
                <div class="print">
                    <b>Giá cả : </b><span>{{$his->price}} &#8363;/ Ngày</span>

                </div>
                <div class="print">
                    <b>Tên cơ sở : </b><span style="font-family: DejaVu Sans;">{{$his->lotel_name}}</span>

                </div>
                <div class="print">
                    <b>Tổng tiền : </b><span>{{$his->sum_price}} &#8363;</span>

                </div>
                <div class="print">
                    <b>Ngày đến : </b><span>{{date('d/m/Y',strtotime($his->checkin))}}</span>

                </div>
                <div class="print">
                    <b>Ngày đi : </b><span>{{date('d/m/Y',strtotime($his->checkout))}}</span>

                </div>
                <div class="print">
                    <b>Ngày đặt : </b><span>{{date('d/m/Y',strtotime($his->created_at))}}</span>

                </div>
                <div class="print">
                    <b>Tên khách hàng : </b><span>{{Auth::user()->name}}</span>

                </div>
                <div class="print">
                    <b>Số điện thoại khách hàng : </b><span>{{Auth::user()->phone}}</span>

                </div>
                @endforeach
            </form>
        </div>
</body>
