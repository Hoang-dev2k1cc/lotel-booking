<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('template/css/register.css') }}">
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
                    <img src="{{ asset('template/img/draw2.svg') }}" alt="" width="100%">
                </div>
                <div class="text-align-center col-4">
                    <div class="logo">
                        <img src="{{ asset('template/img/logo.svg') }}" alt="">
                    </div>
                    <div class="block-title">
                        <h1>Tạo tài khoản mới</h1>
                    </div>
                    @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                    <div class="block-content">
                        <form action="{{ route('postRegister') }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            <input class="form-control" type="text" placeholder="Họ và tên" name="name" required>
                            @error('name')
                                <small class="help-block">{{ $message }}</small>
                            @enderror
                            <input class="form-control" type="password" placeholder=" Mật khẩu" name="password"
                                required>
                            @error('password')
                                <small class="help-block">{{ $message }}</small>
                            @enderror
                            <input class="form-control" type="password" placeholder="Xác Nhận Mật khẩu" name="confirm_password"
                                required>
                            @error('confirm_password')
                                <small class="help-block">{{ $message }}</small>
                            @enderror
                            <input class="form-control" type="email" placeholder="Email" name="email" required>
                            @error('email')
                                <small class="help-block">{{ $message }}</small>
                            @enderror
                            <input class="form-control" type="text" placeholder="Số điện thoại" name="phone"
                                required>
                            @error('phone')
                                <small class="help-block">{{ $message }}</small>
                            @enderror
                            <input class="form-control" type="hidden" value="1" name="role"
                            required>
                            <div class="img-user">
                                <div class="img">Hình ảnh</div>
                                <img src="{{ asset('template/img/user-default.jpg') }}" alt="">
                                <input class="in-img" type="file" name="file_upload" required>
                                @error('file_upload')
                                    <small class="help-block">{{ $message }}</small>
                                @enderror
                                <div class="text-align-center">
                                    <button type="submit" class="submit">Tạo tài khoản</button>
                                    <div class="had">Bạn đã có tài khoản ?<a href="{{ route('show-form-login') }}"
                                            class="login-rsg">Đăng nhập</a></div>
                                </div>
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
