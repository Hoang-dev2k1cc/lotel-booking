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
                        <li class="breadcrumb-item active">Lotel</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @foreach ($data as $room )
    <form action="{{ route('room.update',['id'=>$room->id])}}" method="POST" role="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <label>Tên phòng</label>
                    <input type="text" class="form-control" name="room_name" value="{{$room->room_name}}" required>
                    @error('room_name')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Mã phòng</label>
                    <input type="text" class="form-control" name="room_number" value="{{$room->room_number}}" required>
                    @error('name')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label>Giới thiệu</label>
                    <input value="{{$room->about}}" id="mytextarea" class=" form-control" placeholder="Input description" name="about">
                    @error('about')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>Ảnh ngoài</label>
                    <img src="{{asset('uploads/rooms/'.$room->image)}}" width="60px">
                    <input type="file" class="form-control" name="image" placeholder="Input description">
                    @error('image')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Danh sách ảnh</label>
                    <input type="file" class="form-control" name="image_list[]" placeholder="Input description" multiple
                        id="exampleInputFile">
                    @error('image')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Giá</label>
                    <input name="price" value="{{$room->price}}" class="form-control">
                    @error('price')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Số người lớn</label>
                    <input name="adults" type="number" value="{{$room->adults}}" class="form-control">
                    @error('person')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Sốt trẻ nhỏ</label>
                    <input name="childrens" type="number" value="{{$room->childrens}}" class="form-control">
                    @error('person')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">

                    <input name="status" class="form-control" value="0" type="hidden">
                    @error('status ')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">

                    <input name="id_lotel" class="form-control" value="{{$room->id_lotel}}" type="hidden">


                    @error('status ')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="equipment" style="display:flex;">
                    <h5>Danh sách tiện ích</h5>

                    <ul>
                        @foreach (explode(' , ',$room->equipment) as $eq)
                            <li style="list-style: none;
                                        display:inline-block;
                                        margin-right:5px">
                                <label>{{ $eq }}</label>
                                @if (in_array($eq, explode(' , ', $room->sevices)))

                                <input name="sevices[]" class="" value="{{ $eq }}"
                                    type="checkbox" checked="true">
                        @else
                                    <input name="sevices[]" class="" value="{{ $eq }}"
                                    type="checkbox" >
                                    @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
        <input type="submit" class="btn btn-primary" value="lưu" required>
        @csrf
    </form>
    @endforeach

    <script src="https://cdn.tiny.cloud/1/zj52o6f6zmhv9bezuqab6m6btkxy6nhpf4lur10b7s304la2/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>
@stop
