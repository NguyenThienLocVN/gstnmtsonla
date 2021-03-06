@section('title', 'Đổi mật khẩu')
@extends('layouts.base-wr')

@section('content')
    <div class="bg-page h-100 pt-2 pb-2">
        <!-- Code -->
        <div id="my-modal" class="pb-1">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form action="{{ url('tai-nguyen-nuoc/nguoi-dung/password') }}" method="post" class="col-sm-12">
                @csrf
                    <div class="modal-content p-0 col-md-9 mx-auto">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title text-center col-sm-12 font-weight-bold" id="my-modal-title">Đổi Mật Khẩu</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 col-lg-12 mb-3">
                                    <label for="inputName">Mật khẩu hiện tại</label>
                                    <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" placeholder="" value="">
                                    @if ($errors->has('current_password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('current_password') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-12 mb-3">
                                    <label for="inputName">Mật khẩu mới</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" placeholder="" value="">
                                    @if ($errors->has('new_password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('new_password') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-12 mb-3">
                                    <label for="inputName">Xác nhận mật khẩu</label>
                                    <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password" placeholder="" value="">
                                    @if ($errors->has('confirm_password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('confirm_password') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        <div class="justify-content-end row mx-auto p-0">
                            <button class="btn btn-outline-success col-sm-3 mx-1">Xác nhận</button>
                            <a class="btn btn-outline-danger col-sm-2 mx-0" href="{{ url('tai-nguyen-nuoc/nguoi-dung/thong-tin-nguoi-dung') }}" aria-label="Close">
                                <span aria-hidden="true">Hủy</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="{{ asset('public/js/configMap.js') }}"></script>
<script src="{{ asset('public/js/main.js') }}"></script>
@endsection