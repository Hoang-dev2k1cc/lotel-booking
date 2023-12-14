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
    <form id="searchForm" action="{{route('lotel.search')}} " method="GET">
        <input placeholder="Thành phố, vị trí" type="search" id="edit-name-city" name="key"
            maxlength="128" class="form-search" />

            <input type="submit" id="submitFromSearch" value="Tìm kiếm">
    </form>
    <table class="table table-bordered">
        <thead class= "thead-dark">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Tên cơ sở</th>
                <th class="text-center">Loại hình</th>
                <th class="text-center">Ảnh ngoài</th>
                <th class="text-center">Địa chỉ</th>
                <th class="text-right">Thao tác</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                @foreach ($data as $lot)
                    <td class="text-center">{{ $lot->id }}</td>
                    <td class="text-center">{{ $lot->lotel_name }}</td>

                    <td class="text-center"> {{$lot->name_category}} </td >


                    <td class="text-center"><img src="{{asset('uploads/thumbs/'.$lot->thumb)}}" width="60px"> </td >
                    <td class="text-center">{{ $lot->address}},{{$lot->name_commune}},{{$lot->name_district}},{{$lot->name_province }}</td>
                    <td class="text-right">


                        <a class="btn btn-sm btn-success" href="{{ route('lotel.edit',['id'=>$lot->id ]) }}">
                            <i class="fas fa-edit"></i>
                        </a>

                        <a href="{{ route('lotel.destroy',['id'=>$lot->id ]) }}"class="btnDelete btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                        <a href="{{ route('room.index',['id'=>$lot->id ]) }}"class=" btn btn-sm btn-warning">
                            <i class="fas fa-list"></i>
                        </a>

                        </div>

                    </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{$data->links()}}
    </div>
    <form action="" method="GET" id="form-delete">
        @csrf @method('DELETE')
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
                if (confirm('Bạn có chắc muốn xóa lotel này không?')) {
                    $('form#form-delete').submit();
                }
            });
        });
    </script>

@stop
