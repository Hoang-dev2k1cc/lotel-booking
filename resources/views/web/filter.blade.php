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
    <link rel="stylesheet" href="{{ asset('template/css/filter.css') }}">
    <link rel="stylesheet" href="{{ asset('template/libries/fontawesome-free-6.4.0-web/css/all.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">

    </script>

</head>
<form class="form-fillter" action="{{ route('fillter') }}" method="GET">
    @csrf
    <div class="row fillter-search">
        <div class="col-2 form-group fillter "id="fillter0">
            <label for="name">Nơi muốn đến</label>
            <input type="text" name="province" value="" class="form-control" required>
        </div>
        <div class="col-2 form-group fillter "id="fillter1">
            <label for="name">Ngày đến</label>
            <input type="date" id="checkins-date" name="checkin" value="ngày đến" class="form-control" required>
        </div>
        <div class="col-2 form-group fillter " id="fillter2">
            <label for="name">Ngày trả</label>
            <input class="form-control" type="date" id="checkouts-date" name="checkout" required
                onchange="muFunction()">
        </div>
        <div class="col-2 form-group fillter   "id="fillter3">
            <label for="name">Loại hình</label>
            <select id="search-type" class="form-control" name="id_category">
                <option class="form-control" value="1">Khách sạn</option>
                <option class="form-control" value="2">Homestay</option>
                <option class="form-control" value="3">Nhà nghỉ</option>
            </select>
        </div>
        <div class="col-2 form-group fillter "id="fillter4">
            <label for="name">Số người lớn</label>
            <input type="number" name="adults" value="" class="form-control" required>
        </div>
        <div class="col-2 form-group fillter "id="fillter5">
            <label for="name">Số trẻ em</label>
            <input type="number" name="childrens" value="" class="form-control" required>
        </div>

        <button type="button" class="btn dropdown-toggle dropdown-toggle-split colaps"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="row dropdown-menu ">
            <div style="display:flex">
                <div class="col-6">
                    <label for="name">Khoảng giá</label>
                    <div class="" style="display:flex">
                        <input type="" name="min" value="" id="price" placeholder="TỐI THIỂU"
                            class="form-control" required>
                        <input type="" name="max" value="" id="price" placeholder="TỐI ĐA"
                            class="form-control" required>

                    </div>
                </div>

                <div class="col-6">
                    <div class="equipment">
                        <label for="name">Tiện ích</label>
                        <div class="form-group">
                            <ul
                                style="  margin: 0 auto;
                            text-align: center;
                            left: -22%;
    position: relative; ">
                                @foreach ($equipment = DB::table('equipment')->get() as $eq)
                                    <li
                                        style="list-style: none;
                                        display: inline-block;
    vertical-align: top;

                                          ">
                                        <label>{{ $eq->name }}</label>
                                        <input name="equipment[]" class="" value="{{ $eq->name }}"
                                            type="checkbox" placeholder="TỐI ĐA">
                                        @error('link')
                                            <small class="help-block">{{ $message }}</small>
                                        @enderror
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <label id="nocation" style="color:tomato"></label>


    <button class=" b-filter" type="submit">tìm kiếm</button>
</form>
<script>
    function muFunction() {
        var a = document.getElementById("checkins-date").value
        var b = document.getElementById("checkouts-date").value
        var timestapin = new Date(a).getTime()
        var timestapout = new Date(b).getTime()

        if (timestapin == timestapout) {
            nocation.innerHTML = " Bạn không thể đặt và trả phòng trong cùng một ngày "
        } else {}
    }

    var currentDateTimes = new Date();
    var year = currentDateTimes.getFullYear();
    var month = (currentDateTimes.getMonth() + 1);
    var date = (currentDateTimes.getDate());

    if (date < 10) {
        date = '0' + date;
    }
    if (month < 10) {
        month = '0' + month;
    }

    var dateTomorrow = year + "-" + month + "-" + date;
    var checkinElem = document.querySelector("#checkins-date");
    var checkoutElem = document.querySelector("#checkouts-date");

    checkinElem.setAttribute("min", dateTomorrow);

    checkinElem.onchange = function() {
        checkoutElem.setAttribute("min", this.value);
    }
</script>
