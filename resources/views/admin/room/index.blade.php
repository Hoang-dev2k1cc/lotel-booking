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
        <a href="{{ route('room.create', ['id' => $lot->id]) }}" class="btn btn-primary">Thêm</a>
    @endforeach

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
                <th class="text-right">Thao tác</th>
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
                   <td class="text-center">
                    {{-- @if ($room->status == 0)
                    <a
                    href="{{ route('disable', ['id' => $room->id]) }}"class="btnDisable btn btn-success">
                  Đang hoạt động
                </a>
                    @else
                    <a
                    href="{{ route('able', ['id' => $room->id]) }}"class="btnAble btn btn-danger">
                  Đã dừng
                </a>
                    @endif --}}
                   </td>


                    <td class="text-center">{!! $room->about !!}</td>
                    <td class="text-right">
                        <a class="btn btn-sm btn-success" href="{{ route('room.edit', ['id' => $room->id]) }}">
                            <i class="fas fa-edit"></i>
                        </a>

                        <a href="{{ route('room.destroy', ['id' => $room->id]) }}"class="btnDelete btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>

                        </div>

                    </td>

            </tr>


        </tbody>
        @endforeach
    </table>

    <div class="pagination">
        {{ $data->links() }}
    </div>
    <form action="" method="GET" id="form-delete">
        @csrf @method('DELETE')
    </form>
    <form action="" method="GET" id="form-disable">
        @csrf @method('UPDATE')
    </form>

    <form action="" method="GET" id="form-able">
        @csrf @method('UPDATE')
    </form>
@stop
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".btnDelete").click(function() {
                event.preventDefault();
                var _href = $(this).attr('href');
                $('form#form-delete').attr('action', _href);
                if (confirm('Bạn có chắc muốn xóa room này không?')) {
                    $('form#form-delete').submit();
                }
            });
        });
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".btnDisable").click(function() {
            event.preventDefault();
            var _href = $(this).attr('href');
            $('form#form-disable').attr('action', _href);
            if (confirm('Bạn có chắc muốn vô hiệu hóa phòng không?')) {
                $('form#form-disable').submit();
            }
        });
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".btnAble").click(function() {
            event.preventDefault();
            var _href = $(this).attr('href');
            $('form#form-able').attr('action', _href);
            if (confirm('Bạn có chắc muốn chạy phòng này không?')) {
                $('form#form-able').submit();
            }
        });
    });
</script>

@stop
