<!DOCTYPE html>
<html lang="en">
<head>
	<title>Đăng ký | Hệ thống cơ sở dữ liệu</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/main.css')}}">
	<script src="{{ asset('public/js/jquery-3.5.1.min.js') }}"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-register100 rounded">
				<div class="login100-form-title">
					<img src="{{ asset('public/images/stnmt.png')}}" alt="so-tai-nguyen-moi-truong" class="w-100">
				</div>

				<form class="login100-form px-4 py-4 text-center justify-content-center validate-form position-relative" method="POST" action="{{ route('register') }}">
					@csrf
					<h6 class="font-weight-bold mb-2">THÔNG TIN ĐĂNG KÝ</h6>
					<img src="{{ asset('public/images/logo-tnmt.png') }}" alt="logo-tnmt" class="position-absolute">
					
					<div class="d-flex flex-column flex-md-row w-100 justify-content-between w-100">
						<div class="col-sm-12 col-md-5 p-0 wrap-input100 position-relative validate-input m-b-26" data-validate="Tên đầy đủ là bắt buộc">
							<i class="fa fa-address-card position-absolute" aria-hidden="true"></i>
							<input class="input100 pl-4" type="text" name="fullname" placeholder="Tên đầy đủ">
							<span class="focus-input100"></span>
						</div>
						<div class="col-sm-12 col-md-5 p-0 wrap-input100 position-relative validate-input m-b-26" data-validate="Vui lòng nhập email hợp lệ">
							<i class="fa fa-envelope-o position-absolute" aria-hidden="true"></i>
							<input class="input100 pl-4" type="email" name="email" placeholder="Email">
							<span class="focus-input100"></span>
						</div>
					</div>
					<div class="d-flex flex-column flex-md-row w-100 justify-content-between w-100">
						<div class="col-sm-12 col-md-5 p-0 wrap-input100 position-relative validate-input m-b-26" data-validate="Tên đăng nhập là bắt buộc">
							<i class="fa fa-user position-absolute" aria-hidden="true"></i>
							<input class="input100 pl-4" type="text" name="username" placeholder="Tên đăng nhập">
							<span class="focus-input100"></span>
						</div>
						<div class="col-sm-12 col-md-5 p-0 wrap-input100 position-relative validate-input m-b-26" data-validate="Mật khẩu là bắt buộc">
							<i class="fa fa-lock position-absolute" aria-hidden="true"></i>
							<input class="input100 pl-4" type="password" name="password" placeholder="Mật khẩu">
							<span class="focus-input100"></span>
						</div>
					</div>
					<div class="d-flex flex-column flex-md-row w-100 justify-content-between w-100">
						<div class="col-sm-12 col-md-5 p-0 wrap-input100 position-relative validate-input m-b-26" data-validate="Số điện thoại là bắt buộc">
							<i class="fa fa-phone position-absolute" aria-hidden="true"></i>
							<input class="input100 pl-4" type="text" name="phone" placeholder="Số điện thoại">
							<span class="focus-input100"></span>
						</div>
						<div class="col-sm-12 col-md-5 p-0 position-relative validate-input m-b-26 text-left" data-validate="Cơ quan / Đơn vị">
							<select class="w-100" name="" id="dropdownlist-office" required>
								<option value="" disabled selected>Chọn đơn vị..</option>
								@foreach($offices as $office)
									<option value="{{$office->id}}">{{$office->office_name}}</option>
								@endforeach
							</select>
							<input type="hidden" name="office_id" id="office_id">
						</div>
					</div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger small">{{$error}}</div>
                        @endforeach
                    @endif

					<div class="container-login100-form-btn">
						<button class="btn-success btn mr-2 font-weight-bold"> ĐĂNG KÝ </button>
						hoặc<a class="text-register font-weight-bold" href="{{ route('login') }}">&nbsp;Đăng nhập</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="{{ asset('public/js/auth.js')}}"></script>

</body>
</html>
