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
    @foreach ($data as $lotel)
        <form action="{{ route('lotel.update', ['id' => $lotel->id]) }}" method="POST" role="form"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Tên cơ sở</label>
                        <input class="form-control" name="lotel_name" value="{{ $lotel->lotel_name }}" required>
                        @error('name')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Loại hình</label>
                        <select name="id_category" class="form-control" id="" required>
                            @foreach ($cats as $cat)
                                @if ($cat->id == $lotel->id_category)
                                    <option selected value="{{ $cat->id }}">{{ $cat->name_category }}</option>
                                @else
                                    <option value="{{ $cat->id }}">{{ $cat->name_category }}</option>
                                @endif
                            @endforeach

                        </select>
                        @error('type')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Giới thiệu</label>
                        <textarea name="introduct" id="editor" class=" form-control" >{{$lotel->introduct}}</textarea>

                        @error('introduct')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="equipment">
                        <h5>Danh sách tiện ích</h5>
                        <div class="form-group">
                            <ul>
                                @foreach ($equipment as $eq)

                                        <li
                                            style="list-style: none;
                            display:inline-block;
                            margin-right:5px">
                                            <label>{{ $eq->name }}</label>
                                            @if (in_array($eq->name, explode(' , ', $lotel->equipment)))

                                            <input name="equipment[]" class="" value="{{ $eq->name }}"
                                                type="checkbox" checked="true">
                                    @else
                                                <input name="equipment[]" class="" value="{{ $eq->name }}"
                                                type="checkbox" >
                                                @endif
                                            @error('link')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </li>
                                @endforeach
                            </ul>

                        </div>

                    </div>
                </div>
                <div class="col-md-5">


                    <div class="form-group">
                        <label>Ảnh ngoài</label>
                        <img src="{{ asset('uploads/thumbs/' . $lotel->thumb) }}" width="60px" height="30px">
                        <input type="file" name="thumb" placeholder="Input description" class="form-control">
                        @error('image')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Danh sách ảnh</label>
                        <input type="file" class="form-control" name="image_list[]" placeholder="Input description"
                            multiple id="exampleInputFile">
                        @error('image')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Giá cả</label>
                        <input value="{{$lotel->price_day}}" id="mytextarea" class=" form-control" placeholder="Input description"
                            name="price_day">
                        @error('price_day')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Số người tối đa</label>
                        <input value="{{$lotel->person}}" id="mytextarea" class=" form-control" placeholder="Input description"
                            name="person">
                        @error('price_day')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <label for="name">Địa chỉ</label>
                    <div class="form-group" style="display:flex">

                        <input name="address" class="form-control" value="{{$lotel->address}}">
                        <select id="search-type" class="form-control" name="province">
                            <option></option>
                            @foreach ($province as $pro)
                            @if($pro->id == $lotel->province )
                                <option selected value="{{ $pro->id }}">{{ $pro->name_province }}</option>
                            @else
                            <option  value="{{ $pro->id }}">{{ $pro->name_province }}</option>
                            @endif
                            @endforeach
                        </select>
                        <select id="" class=" form-control" name="district">

                            @foreach ($district as $dis)
                            @if($dis->id == $lotel->district )
                                <option selected value="{{ $dis->id }}">{{ $dis->name_district }}</option>
                            @else
                            <option  value="{{ $dis->id }}">{{ $dis->name_district }}</option>
                            @endif
                            @endforeach

                        </select>
                        <select id="" class="form-control" name="commune">

                            @foreach ($commune as $com)
                            @if($com->id == $lotel->commune )
                                <option selected value="{{ $dis->id }}">{{ $com->name_commune }}</option>
                            @else
                            <option  value="{{ $com->id }}">{{ $com->name_commune }}</option>
                            @endif
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Liên lạc</label>
                        <input name="contact" class="form-control" value="{{ $lotel->contact }}">
                        @error('contact ')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Vị trí Google map</label>
                        <input name="located" class="form-control" value="{{ $lotel->located }}">
                        @error('link')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" required>Lưu</button>
        </form>
    @endforeach

    <script>
        var pro = @json($province, JSON_PRETTY_PRINT);
        var dis = @json($district, JSON_PRETTY_PRINT);
        var com = @json($commune, JSON_PRETTY_PRINT);
        document.querySelector('[name="province"]').addEventListener("change", function() {
            var id_pro = this.value
            var list_dis = dis.filter((item) => item.id_province == id_pro);
            var list_op_dis = ""
            for (let i = 0; i < list_dis.length; i++) {

                list_op_dis += "<option selected value='" + list_dis[i]["id"] + "'>" + list_dis[i][
                    "name_district"] + "</option>"

            }
            document.querySelector('[name="district"]').innerHTML = list_op_dis
        });


        document.querySelector('[name="district"]').addEventListener("change", function() {
            var id_dis = this.value
            var list_com = com.filter((item) => item.id_district == id_dis);
            var list_op_com = ""
            for (let i = 0; i < list_com.length; i++) {

                list_op_com += "<option selected value='" + list_com[i]["id"] + "'>" + list_com[i]["name_commune"] +
                    "</option>"

            }
            document.querySelector('[name="commune"]').innerHTML = list_op_com
        });
    </script>
     <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
     <script>
         ClassicEditor
             .create( document.querySelector( '#editor' ) )
             .catch( error => {
                 console.error( error );
             } );
     </script>
@stop
