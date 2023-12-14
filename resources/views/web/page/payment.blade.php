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

            <nav class="tab">
                <nav class="tabs-wrapper tabs-primary is-collapsible"
                    aria-labelledby="primary-tabs-title" data-drupal-nav-tabs
                    data-once="nav-tabs">
                    <ul
                        class="nav nav-tabs flex-column flex-md-row primary clearfix"
                        data-drupal-nav-tabs-target> <li class="nav-item">
                            <a href=""
                                class="nav-link"
                                data-drupal-link-system-path="user/8397/payment-methods">xem</a>
                        </li>
                        <li class="nav-item active">
                            <a href="{{route('userPayment',['id'=>Auth::user()->id])}}"
                                class="active is-active nav-link disabled"
                                data-drupal-link-system-path="user/8397">Phương
                                thức thanh toán<span
                                    class="visually-hidden">(tab hoạt động)</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('userEdit',['id'=>Auth::user()->id])}}" class="nav-link"
                                data-drupal-link-system-path="">Sửa</a>
                        </li>
                    </ul>

                </nav>
                <nav class="nav mt-3"><li class="nav-item"><a
                            href=""
                            class="button button-action nav-link active btn"
                            data-drupal-link-system-path="">Add
                            payment method</a></li>
                </nav>
                <div id="block-manmo-content">

                    <div class="table-responsive">
                        <div class="tableresponsive-toggle-columns"><button
                                type="button"
                                class="link tableresponsive-toggle"
                                title="Show table cells that were hidden to make the table fit within a small screen."
                                style="display: none;">Hide lower priority
                                columns</button></div><table
                            class="responsive-enabled table" data-striping="1"
                            data-once="tableresponsive">
                            <thead>
                                <tr>
                                    <th>Payment method</th>
                                    <th>Hết hạn</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd">
                                    <td colspan="3" class="empty message">There
                                        are no payment methods yet.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </nav>
        </div>

    </body>
    @include('layouts.footer')
</html>