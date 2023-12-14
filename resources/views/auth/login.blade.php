<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('template/css/login.css') }}">
    <link rel="stylesheet" href="{{asset('libries/fontawesome-free-6.4.0-web/css/all.css')}}">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <nav>
            <div class="row main">
                <div class=" main-left col-8">
                    <img src="{{asset('template/img/anhlogin.jpg')}}" alt="" width="100%">
                </div>
                <div class="text-align-center col-4">
                    <div class="logo">
                        <img src="{{ asset('template/img/logo.svg') }}" alt="">
                    </div>
                    <div class="block-title">
                        <h1>Đăng nhập</h1>
                    </div>
                    @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                @if (session()->has('nocation'))
                    <div class="alert alert-danger">
                        {{ session()->get('nocation') }}
                    </div>
                @endif
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
                    <div class="block-content">
                        <form action="{{ route('postLogin') }}" method="POST" role="form">

                            <input class="form-control" type="email" placeholder="email" required name="email">
                            <input class="form-control" type="password" placeholder="Mật khẩu" required name="password">



                                    <button id="button-login" type="submit" class=" submit" style="position: relative;
                                    left: -42px;">Đăng nhập</button>


                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </div>

</body>

</html>

