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
                    <li class="breadcrumb-item active">Category</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
    <!-- Main content -->
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th >ID</th>
                <th >Tên tiện ích</th>
                <th >Thời gian</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($data as $cat)
                    <td >{{ $cat->id }}</td>
                    <td >{{ $cat->name }}</td>
                    <td >{{ date('d/m/Y',strtotime ($cat->created_at)) }}</td>
                    <td class="text-right">


                        <a class="btn btn-sm btn-success" href="{{ route('equipment.edit',['id'=>$cat->id ]) }}">
                            <i class="fas fa-edit"></i>
                        </a>

                        <a href="{{ route('equipment.destroy',['id'=>$cat->id ]) }}"class="btnDelete btn btn-sm btn-danger">
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
    {{-- <script>
    $(".btnDelete").click(function(event){
        event.preventDefault();
        var _href = $(this).attr('href');
        alert(_href);
        $('form#form-delete').attr('action',_href);
        if(confirm('Bạn có chắc muốn xóa danh mục này không?')){
            $('form#form-delete').submit();
        }
    })


  </script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".btnDelete").click(function() {
                event.preventDefault();
                var _href = $(this).attr('href');
                $('form#form-delete').attr('action', _href);
                if (confirm('Bạn có chắc muốn xóa danh mục này không?')) {
                    $('form#form-delete').submit();
                }
            });
        });
    </script>
@stop
