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
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <form action="{{ route('users.update', ['id' => $us->id]) }}" method="POST" role="form" enctype="multipart/form-data">

        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $us->name }}" required>
                    @error('name')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input value="{{ $us->email }}" name="email" class=" form-control" required>
                    @error('email')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <img src="{{asset('uploads/users/'. $us->photo)}}" width="60px">
                    <input type="file" name="file_upload" class="form-control" placeholder="Input description">
                    @error('file_upload')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-5">

                <div class="form-group">
                    <label>Phone</label>
                    <input value="{{$us->phone}}" name="phone" class=" form-control" required type="number">
                    @error('phone')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" required>Lưu</button>
        @csrf
    </form>
@stop
