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
                        <li class="breadcrumb-item active">Equipment</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-5">
            <form action="{{ route('equipment.store') }}" method="POST" role="form">
                @csrf

                <div class="form-group">
                    <label>Tên tiện ích</label>
                    <input type="text" class="form-control" name="name" required>
                    @error('name')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary" required>Lưu</button>
            </form>
        </div>
    </div>
@stop
