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
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        <option ></option>
                        @foreach ($province as $pro)
                                <option value="{{ $pro->id }}">{{ $pro->name_province }}</option>
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
                        <option ></option>
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
                    <h3>{{ count($homestays) }} </h3>
                    <p>HomeStay</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <form action="{{ route('admin.homestay.search') }}" method="GET">
                    <select class="form-control" name="homestay_id" required>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        <option ></option>
                        @foreach ($province as $pro)
                            <option value="{{ $pro->id }}">{{ $pro->name_province }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></button>
                </form>
            </div>
        </div>

    @stop()
