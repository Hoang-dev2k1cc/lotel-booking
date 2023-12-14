@extends('layouts.admin')
@section('main')
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
    @foreach ($lotel as $lot)
       <h5>{{$lot->lotel_name}}</h5>
    @endforeach
    <h4> Tổng : {{ count($datas) }}</h4>
    <table class="table table-bordered">
        <thead class= "thead-dark">
            <tr>
                <th class="text-center">Mã phòng</th>
                <th class="text-center">Tên phòng</th>
                <th class="text-center">Hình ảnh</th>
                <th class="text-center">Giá</th>
                <th class="text-center">số khách tối đa</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">Mô tả</th>

            </tr>
        </thead>


        <tbody>
            <tr>
                @foreach ($data as $room)
                    <td class="text-center">{{ $room->room_number }}</td>
                    <td class="text-center">{{ $room->room_name }}</td>
                    <td class="text-center"><img src="{{ asset('uploads/rooms/' . $room->image) }}" width="60px"> </td>
                    <td class="text-center">{{ $room->price }}</td>
                    <td class="text-center"><b>Người lớn:</b>{{ $room->adults }}
                                            <br><b>Trẻ em:</b>{{ $room->childrens }}
                    </td>
                    @if ($room->status == 0)
                        <td class="text-center">Đang trống</td>
                    @else
                        <td class="text-center">Đã được thuê</td>
                    @endif


                    <td class="text-center">{!! $room->about !!}</td>

            </tr>


        </tbody>
        @endforeach
    </table>

    <div class="pagination">
        {{ $data->links() }}
    </div>

@stop

