@extends('layouts.admin')
@section('main')
    <div class="row">
        <div class="col-lg-4 col-6">

            <div class="small-box bg-info">
                <div class="inner">

                    <h3>{{ count($hotels) }} </h3>

                    <p>Khách sạn</p>

                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <form action="{{ route('admin.hotel.search') }}" method="GET">
                    <select class="form-control" name="hotel_id" required>
                        <option></option>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        @foreach ($province as $pro)
                            <option value="{{ $pro->id }}">
                                {{ $pro->name_province }}</option>
                        @endforeach

                    </select>
                    <button type="submit" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></button>
                </form>

            </div>
        </div>

        <div class="col-lg-4 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ count($motels) }} </h3>
                    <p>Nhà Nghỉ</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <form action="{{ route('admin.motel.search') }}" method="GET">
                    <select class="form-control" name="motel_id" required>
                        <option value=""></option>
                        @foreach ($province as $pro)
                            <option value="{{ $pro->id }}">
                                {{ $pro->name_province }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></button>
                </form>
            </div>
        </div>

        <div class="col-lg-4 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    @if (isset($data))
                        <h3>{{ count($data) }} </h3>
                    @else
                        <h3>{{ count($homestays) }} </h3>
                    @endif

                    <p>HomeStay</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <form action="{{ route('admin.homestay.search') }}" method="GET">
                    <select class="form-control" name="homestay_id" required>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

                        @foreach ($province as $pro)
                            @if ($pro->id == $homestay_id)
                                <option selected value="{{ $pro->id }}">{{ $pro->name_province }}</option>
                            @else
                                <option value="{{ $pro->id }}">{{ $pro->name_province }}</option>
                            @endif
                        @endforeach

                    </select>
                    <button type="submit" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></button>
                </form>
            </div>
        </div>
        <div class="container">


            <h4> Tổng : {{ count($data) }}</h4>
            <table class="table table-bordered">
                <thead class= "thead-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Tên Cơ sở Lưu trú</th>
                        <th class="text-center">Loại hình</th>
                        <th class="text-center">Địa chỉ</th>
                        <th class="text-center">Thumb</th>
                        <th class="text-center">xem phòng</th>


                    </tr>
                </thead>

                <tbody>

                    @foreach ($datas as $sta)
                        <tr>
                            <td class="text-center">{{ $sta->id }} </td>
                            <td class="text-center">{{ $sta->lotel_name }}</td>
                            <td class="text-center">{{ $sta->name_category }}</td>
                            <td class="text-center">
                                {{ $sta->address }} , {{ $sta->name_commune }} , {{ $sta->name_district }} ,
                                {{ $sta->name_province }}
                            </td>
                            <td class="text-center"><img src="{{ asset('uploads/thumbs/' . $sta->thumb) }}" width="60px"
                                    height="60px"></td>
                                    <td class="text-center"><a href="{{route('roomStatis',['id'=>$sta->id])}}">Xem</a></td>
                        </tr>
                    @endforeach



                </tbody>
            </table>

            <div class="pagination">
                {{$datas->appends(request()->all())->links()}}
            </div>

        </div>
    @stop()
