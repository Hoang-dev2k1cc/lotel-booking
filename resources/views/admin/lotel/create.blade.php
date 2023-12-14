@extends('layouts.admin')
@section('main')
<head>
    <style>
        .adr{
            width:25%;
        }
    </style>
</head>
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
    <form action="{{ route('lotel.store') }}" method="POST" role="form" enctype="multipart/form-data">

        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <label>Tên cơ sở</label>
                    <input type="text" class="form-control" name="lotel_name" value="" required>
                    @error('name')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Loại Hình</label>
                    <select name="id_category" class="form-control" id="" required>
                        @foreach ($cats as $cat)
                            <option selected value="{{ $cat->id }}">{{ $cat->name_category }}</option>
                        @endforeach

                    </select>
                    @error('type')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Giới thiệu</label>
                    <textarea name="introduct" id="editor" class=" form-control" placeholder="Input description"></textarea>
                    @error('introduct')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Giá cả</label>
                    <input value="" id="mytextarea" class=" form-control" placeholder="Input description"
                        name="price_day">
                    @error('price_day')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Giới hạn số người</label>
                    <input value="" id="mytextarea" class=" form-control" placeholder="Input description"
                        name="person">
                    @error('price_day')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>


            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>Ảnh ngoài</label>

                    <input type="file" name="file_upload" placeholder="Input description" class="form-control">
                    @error('image')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Danh sách ảnh</label>

                    <input type="file" class="form-control" name="image_list[]" placeholder="Input description" multiple
                        id="exampleInputFile">
                    @error('image_list')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Số điện thoại liên hệ</label>
                    <input name="contact" class="form-control" value="">
                    @error('contact ')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <label for="name">Địa chỉ</label>
                <div class="form-group" style="display:flex">
                    <div class="adr">
                        <p>số nhà</p>
                        <input name="address" class="form-control" value="">
                    </div>

                    <div class="adr">
                        <p>Tỉnh</p>
                        <select id="search-type" class="form-control" name="province">
                            <option></option>
                            @foreach ($province as $pro)
                                <option value="{{ $pro->id }}">{{ $pro->name_province }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="adr">
                        <p>Huyện</p>
                        <select id="" class=" form-control" name="district">

                            <option selected value=""></option>

                        </select>
                    </div>
                    <div class="adr">
                        <p>Xã</p>
                        <select id="" class="form-control" name="commune">

                            <option selected value=""></option>

                        </select>
                    </div>
                </div>
                <div class="equipment">
                    <label>Tiện ích</label>

                    <div class="form-group">
                        <ul>
                            @foreach ($equipment as $eq)
                                <li
                                    style="list-style: none;
                                            display:inline-block;
                                            margin-right:5px">
                                    <label>{{ $eq->name }}</label>
                                    <input name="equipment[]" class="" value="{{ $eq->name }}" type="checkbox">
                                    @error('link')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </li>
                            @endforeach
                        </ul>

                    </div>

                </div>
                <div class="form-group">
                    <label>Vị trí Google map</label>
                    <input name="located" class="form-control" value="">
                    @error('link')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>

            </div>

        </div>
        <input type="submit" class="btn btn-primary" value="lưu" required>
        @csrf

    </form>
    <script src="https://cdn.tiny.cloud/1/zj52o6f6zmhv9bezuqab6m6btkxy6nhpf4lur10b7s304la2/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/collect.js/4.36.1/collect.js"></script>




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
                    "name_district"
                ] + "</option>"

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
