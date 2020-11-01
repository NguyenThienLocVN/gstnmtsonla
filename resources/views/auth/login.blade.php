<!DOCTYPE html>
<html lang="en">
<head>
	<title>Đăng nhập | Hệ thống cơ sở dữ liệu</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/main.css')}}">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 rounded">
				<div class="login100-form-title">
					<img src="{{ asset('public/images/stnmt.png')}}" alt="so-tai-nguyen-moi-truong" class="w-100">
				</div>

				<form class="login100-form p-5 text-center justify-content-center validate-form position-relative" method="POST" action="{{ route('login') }}">
					@csrf
					<img src="{{ asset('public/images/logo-tnmt.png')}}" alt="logo-tnmt" class="position-absolute">
					<div class="wrap-input100 position-relative validate-input m-b-26" data-validate="Tên đăng nhập là bắt buộc">
						<i class="fa fa-user position-absolute" aria-hidden="true"></i>
						<input id="username" value="{{ old('username') }}" class="input100 px-5" type="text" name="username" placeholder="Tên đăng nhập" required autofocus>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 position-relative validate-input m-b-18" data-validate = "Mật khẩu là bắt buộc">
						<i class="fa fa-lock position-absolute" aria-hidden="true"></i>
						<input id="password" class="input100 px-5" type="password" name="password" placeholder="Mật khẩu">
						<span class="focus-input100"></span>
					</div>

					@if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger small">{{$error}}</div>
                        @endforeach
                    @endif

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Ghi nhớ
							</label>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="btn-success btn mr-2"> ĐĂNG NHẬP </button>
						hoặc<a class="text-register font-weight-bold" href="register.html">&nbsp;Tạo tài khoản</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>
