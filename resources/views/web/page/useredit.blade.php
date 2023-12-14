<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('template/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('template/libries/fontawesome-free-6.4.0-web/css/all.css') }}">
    <!-- Latest compiled and minified CSS -->

</head>

<body>
    <div class="container">
        <div class="row header">
            <div class=" logo col-3">
                <a href="{{route('home')}}"><img src="{{asset('template/img/logo.svg')}}" alt=""></a>
            </div>
            <div class="col-4">
                <form id="searchForm" action="{{route('search')}} " method="GET">
                    <input placeholder="Thành phố, vị trí" type="search" id="edit-name-city" name="key"
                        maxlength="128" class="form-search form-control" />

                        <input type="submit" id="submitFromSearch" value="Tìm kiếm">
                </form>
            </div>

            <div class="col-2">

            </div>
            <div class="col-2">
            </div>
            @if ( Auth::check())
            <div class=" user col-1">
                <div class="dropdown">
                <img class="dropbtn" onclick="myFunction()" src="{{asset('uploads/users/'.Auth::user()->photo)}}" >
                   <div id="myDropdown" class="dropdown-content">
                     <a href="{{route('history',['id'=> Auth::user()->id])}}">Lịch Sử</a>

                     <a href="{{route('userInfor',['id'=> Auth::user()->id])}}">Thông Tin</a>
                     <a href="{{route('logout')}}">Đăng xuất</a>
                   </div>
                 </div>
            </div>
            @else
            <div class=" user col-1">

                <div class="dropdown">
                     <i class=" dropbtn fa-solid fa-user" aria-hidden="trues" onclick="myFunction()"></i>
                   <div id="myDropdown" class="dropdown-content">
                     <a href="{{route('showRegister')}}">Đăng Ký</a>
                     <a href="{{route('show-form-login')}}">Đăng Nhập</a>
                   </div>
                 </div>
            </div>
            @endif
        </div>
    </div>
    <div class="container">

        <nav>
            <div class="row main">
                <div class=" main-left col-8">
                    <img src="{{ asset('template/img/draw2.svg') }}" alt width="100%">
                </div>
                <div class="text-align-center col-4">
                    <div class="block-content">
                        <div id="page-title" class="page-title-text-center">
                            <h1 class="display-4 page-title">{{Auth::user()->email}}</h1>
                        </div>
                        @if (Session::has('success'))
                        <div class="alert alert-success">

                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                        <form class="user-form" action="{{route('updateUser',['id'=>Auth::user()->id])}}" method="POST" enctype="multipart/form-data">
                            <div data-drupal-selector="edit-account" id="edit-account"
                                class="js-form-wrapper form-wrapper">
                                <div
                                    class="js-form-item form-item js-form-type--password form-type--password js-form-item-current-pass form-item-current-pass mb-3">
                                    <label for="edit-current-pass" class="col-form-label">Mật khẩu hiện
                                        tại</label>
                                    <input class="form-text form-control" type="password" name="password_old" value="{{Auth::user()->password}}">
                                </div>
                                <div
                                    class="js-form-item form-item js-form-type--password form-type--password js-form-item-pass-pass2 form-item-pass-pass2 mb-3">
                                    <label for="edit-pass-pass2" class="col-form-label">
                                        Mật khẩu mới</label>
                                    <input class="password-new js-password-new form-text form-control"
                                        name="password_new"  type="password" required>
                                        @error('password_new')
                                    <small class="help-block">{{ $message }}</small>
                                @enderror
                                </div>
                                <div
                                    class="js-form-item form-item js-form-type--password form-type--password js-form-item-pass-pass2 form-item-pass-pass2 mb-3">
                                    <label for="edit-pass-pass2" class="col-form-label">Xác nhận
                                        mật khẩu</label>
                                    <input class="password-confirm js-password-confirm form-text form-control"
                                    name="password-confirm" required  type="password">
                                    @error('password-confirm')
                                    <small class="help-block">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>
                            <div
                                class="js-form-item form-item js-form-type--email form-type--email js-form-item-mail form-item-mail mb-3">
                                <label for="edit-mail" class="col-form-label js-form-required form-required">Địa
                                    chỉ thư điện tử</label>
                                <input class="form-email required form-control" required aria-required="true"
                                    name="email" value="{{Auth::user()->email}}" required>
                                    @error('email')
                                    <small class="help-block">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="field--type-telephone field--name-field-phone field--widget-telephone-default js-form-wrapper form-wrapper"
                                data-drupal-selector="edit-field-phone-wrapper" id="edit-field-phone-wrapper">
                                <div
                                    class="js-form-item form-item js-form-type--tel form-type--tel js-form-item-field-phone-0-value form-item-field-phone-0-value mb-3">
                                    <label for="edit-field-phone-0-value"
                                        class="col-form-label js-form-required form-required">Số
                                        điện thoại</label>

                                    <input class="form-tel required form-control" required
                                        aria-required="true" name="phone" value="{{Auth::user()->phone}}">
                                        @error('phone')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                    <input class="form-tel required form-control" required
                                        aria-required="true" name="role" type="hidden">
                                </div>
                            </div>
                            <div class="field--type-image field--name-user-picture field--widget-image-image js-form-wrapper form-wrapper"
                                data-drupal-selector="edit-user-picture-wrapper" id="edit-user-picture-wrapper">
                                <div id="ajax-wrapper">
                                    <div
                                        class="js-form-item form-item js-form-type--managed-file form-type--managed-file js-form-item-user-picture-0 form-item-user-picture-0 mb-3">
                                        <label for="edit-user-picture-0-upload" id="edit-user-picture-0--label"
                                            class="col-form-label">Hình ảnh</label>
                                        <div class="image-widget js-form-managed-file form-managed-file clearfix">
                                            <img src="{{ asset('uploads/users/'.Auth::user()->photo) }}" width="100"
                                                height="61" alt loading="lazy" typeof="foaf:Image"
                                                class="image-style-thumbnail">
                                            <input type="file" name="photo">
                                        </div>
                                        <div id="edit-user-picture-0--description" class="description form-text">
                                            Your virtual face or picture.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-drupal-selector="edit-actions" class="form-actions js-form-wrapper form-wrapper"
                                id="edit-actions">
                                <button type="submit" class="btn btn-primary" required>Lưu</button>

                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </div>

</body>
<script>
    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
    </script>

</html>
