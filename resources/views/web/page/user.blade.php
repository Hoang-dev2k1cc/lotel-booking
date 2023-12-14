<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('template/css/index.css')}}">
    <link rel="stylesheet" href="{{asset('template/libries/fontawesome-free-6.4.0-web/css/all.css')}}">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
            @if (Session::has('error'))
            <div class="alert alert-danger">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('error') }}
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('success') }}
            </div>
        @endif
            <div id="block-manmo-page-title"
                class="mx-md-5 mx-3 mt-3 text-center">
                <h1 class="display-4 page-title">{{Auth::user()->name}}</h1>
            </div>
            <nav class="tab">
                <nav class="tabs-wrapper tabs-primary is-collapsible"
                    aria-labelledby="primary-tabs-title" data-drupal-nav-tabs
                    data-once="nav-tabs">
                    <ul
                        class="nav nav-tabs flex-column flex-md-row primary clearfix"
                        data-drupal-nav-tabs-target><li class="nav-item active">
                            <a href="/user/8397"
                                class="active is-active nav-link disabled"
                                data-drupal-link-system-path="user/8397">Xem<span
                                    class="visually-hidden">(tab hoạt động)</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('userEdit',['id'=>Auth::user()->id])}}" class="nav-link"
                                data-drupal-link-system-path="edit.html">Sửa</a>
                        </li>
                    </ul>
                    <article typeof="schema:Person" about="/user/8397"
                        class="profile">

                        <div
                            class="row d-flex justify-content-center form-profile-manmo">

                            <div class="col-12 col-md-5 bg-light row shadow">
                                <div
                                    class="col-12 col-md-4 bg-white rounded m-2 p-2">
                                    <div
                                        class="field field--name-user-picture field--type-image field--label-hidden field--item">
                                        <a href="/user/8397" hreflang="vi"><img
                                                src="{{asset('uploads/users/'.Auth::user()->photo)}}"
                                                width="100%" height="100%"
                                                alt="Profile picture for user hoang2k1cc@gmail.com"
                                                loading="lazy"
                                                typeof="foaf:Image"
                                                class="image-style-thumbnail">
                                        </a>
                                    </div>
                                </div>
                                <div
                                    class="col-12 col-md-7 bg-white rounded m-2 p-2">
                                    <div
                                    class="field field--name-field-phone field--type-telephone field--label-above">
                                    <div class="field--label">Email</div>
                                    <div class="field--item">{{Auth::user()->email}}</div>
                                </div>
                                    <div
                                        class="field field--name-field-phone field--type-telephone field--label-above">
                                        <div class="field--label">Số điện thoại</div>
                                        <div class="field--item">{{Auth::user()->phone}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </nav>
            </nav>
        </div>
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

    </body>
    @include('layouts.footer')

</html>
