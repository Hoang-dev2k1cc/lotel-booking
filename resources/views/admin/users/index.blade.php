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
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
    <!-- Main content -->
    <table class="table table-bordered">
        <thead class= "thead-dark">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Họ và tên</th>
                <th class="text-center">Email</th>
                <th class="text-center">Số điện thoại</th>
                <th class="text-center">Thời điểm thêm</th>
                <th class="text-right">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($data as $us)
                    <td class="text-center">{{ $us->id }}</td>
                    <td class="text-center">{{ $us->name }}</td>
                    <td class="text-center">{{ $us->email }}</td >
                    <td class="text-center">{{ $us->phone }}</td >

                    <td class="text-center">{{ date('d/m/Y',strtotime ($us->created_at)) }}</td>

                    <td class="text-right">


                        <a class="btn btn-sm btn-success" href="{{ route('users.edit',['id'=>$us->id ]) }}">
                            <i class="fas fa-edit"></i>
                        </a>

                        <a href="{{ route('users.destroy',['id'=>$us->id ]) }}"class="btnDelete btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>

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
