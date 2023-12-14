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
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <form action="{{ route('category.store') }}" method="POST" role="form">
        @csrf
        <div class="form-group">
            <label>Tên danh mục</label>
            <input type="text" class="form-control" name="name_category" required>
            @error('name_category')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" required>Lưu</button>
    </form>
@stop
