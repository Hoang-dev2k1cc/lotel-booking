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
                        <li class="breadcrumb-item active">News</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @foreach ($news as $new)
    <form action="{{ route('news.update', ['id' => $new->id]) }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" class="form-control" name="name" required value="{{$new->name}}">
                    @error('name')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>

                <label>Giới thiệu</label>
                <input name="introduct"  class=" form-control" placeholder="Input description" value="{{$new->introduct}}">
                @error('content')
                    <small class="help-block">{{ $message }}</small>
                @enderror
                <div class="form-group">
                    <label>Nội dung</label>
                    <textarea name="content" id="editor" class=" form-control" placeholder="Input description" >{{$new->content}}</textarea>
                    @error('content')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>


            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Ảnh ngoài</label>
                    <img src="{{asset('uploads/news/'. $new->image)}}" width="60px" height="50px">
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
