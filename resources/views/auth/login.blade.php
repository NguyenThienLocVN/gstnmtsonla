<!DOCTYPE html>
<html lang="en">
<head>
	<title>Đăng nhập | Hệ thống cơ sở dữ liệu</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/main.css')}}">
</head>
<body>
	<div class="limiter">
		<div class="container-login100 flex-column">
			@if(session('success'))
				<div class="alert alert-success">{{session('success')}}</div>
			@endif
			<div class="wrap-login100 rounded">
				<div class="login100-form-title">
					<img src="{{ asset('public/images/stnmt.png')}}" alt="so-tai-nguyen-moi-truong" class="w-100">
				</div>

				<form class="login100-form p-5 text-center justify-content-center validate-form position-relative" method="POST" action="{{ route('login') }}">
					@csrf
					<img src="{{ asset('public/images/logo-tnmt.png')}}" alt="logo-tnmt" class="position-absolute">
					<div class="position-relative wrap-input100 mb-3">
						<div class="position-relative validate-input d-flex" data-validate="Tên đăng nhập là bắt buộc">
							<i class="fa fa-user position-absolute px-1" aria-hidden="true"></i>
							<input id="username" value="{{ old('username') }}" class="input100 pl-4" type="text" name="username" placeholder="Tên đăng nhập" required>
							<span id="btn-select-dropdown-office" class="btn-select-dropdown text-white bg-light text-dark text-center"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
						</div>
						<ul id="dropdownlist-office" style="display: none;" class="dropdownlist-office position-absolute font-13 w-100 text-left bg-light">
							@foreach($offices as $office)
								<li class="p-1" id="{{$office->id}}">{{$office->office_name}}</li>
							@endforeach
						</ul>
					</div>

					<div class="wrap-input100 position-relative validate-input m-b-18" data-validate = "Mật khẩu là bắt buộc">
						<i class="fa fa-lock position-absolute px-1" aria-hidden="true"></i>
						<input id="password" class="input100 pl-4" type="password" name="password" placeholder="Mật khẩu">
						<span class="focus-input100"></span>
					</div>

					@if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger small px-2">{{$error}}</div>
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
						<span>hoặc</span><a class="text-register font-weight-bold" href="{{ route('register') }}">&nbsp;Tạo tài khoản</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"></script>
	<script src="{{ asset('public/js/auth.js')}}"></script>

</body>
</html>
