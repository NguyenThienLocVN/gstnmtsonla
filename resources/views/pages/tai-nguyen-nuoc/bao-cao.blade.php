@section('title', 'Báo cáo | Hệ thống quản lý, giám sát, khai thác sử dụng tài nguyên nước')
@extends('layouts.base')

@section('content')
<main class="main-welcom container-fluid p-0 position-relative">
    <div class="text-center w-100 bg-light">
        <h6 class="text-primary p-2 font-weight-bold">HỆ THỐNG QUẢN LÝ, GIÁM SÁT, KHAI THÁC SỬ DỤNG TÀI NGUYÊN NƯỚC - TỈNH SƠN LA</h6>
    </div>
    @include('layouts.navigation-water-resource')
    <div class="wrap-content w-100 row m-0 p-0 justify-content-between">
        <?php $i = 1; ?>
        @foreach($reports as $rp)
        <div class="col-md-3 card-deck py-2">
          <div class="card mb-2 mt-4 mx-0">
            <div class="p-3">
            <img class="w-100 pb-3" src="{{ asset('public/images/icon/microsoft-word-icon.png') }}" alt="microsoft-word-icon">
              <h6 class="card-title font-weight-bold">Biểu mẫu số {{$rp->id}}</h6>
              <p class="card-subtitle text-muted pb-3">{{ $rp->report_name }}</p>
              <a href="#" class="btn btn-primary">Xem thêm</a>
            </div>
          </div>
        </div>
        <!-- <div class="col-4 card-deck">
            <div class="card report-item col-12 p-2 mt-2"> -->
                <!-- <div class="image">
                    <img class="w-100" src="{{ asset('public/images/icon/microsoft-word-icon.png') }}" alt="microsoft-word-icon">
                </div> -->
                <!-- <div class="text">
                    <h6 class="card-title mb-2 pb-1 font-weight-bold">Biểu mẫu số {{$i}}</h6>
                    <p class="card-text font-weight-bold">{{ $rp->report_name }} </p>
                </div>
            </div>
        </div> -->
        <?php $i++; ?>
        @endforeach

        <div class="text-center d-flex justify-content-center w-100 pt-3 pb-5">
            {{ $reports->links() }}
        </div>
    </div>
</main>

<script src="{{ asset('public/js/openLayersSonLa.js') }}"></script>
@endsection