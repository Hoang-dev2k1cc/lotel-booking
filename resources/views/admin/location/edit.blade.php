@extends('layouts.admin')
@section('main')
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Trang Quản Lý</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">locations</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @foreach ($location as $locat)
    <form action="{{ route('location.update', ['id' => $locat->id]) }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <label>Tiêu đề cẩm nang</label>
                    <input type="text" class="form-control" value="{{$locat->name}}" name="name" required>
                    @error('name')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Link</label>
                    <input name="link" class=" form-control" value="{{$locat->link}}" type="text">
                    @error('content')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Ảnh ngoài</label>
                    <img src="{{asset('uploads/locations/'. $locat->image)}}" width="60px" height="50px">
                    <input type="file" name="image" class="form-control" placeholder="Input description">
                    @error('image')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" required>Lưu</button>
    </form>
    @endforeach
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@stop
