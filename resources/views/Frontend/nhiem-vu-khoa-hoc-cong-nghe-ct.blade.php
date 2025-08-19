@extends('Frontend.layout')
@section('title', __($ds['ten_nhiem_vu']))
@section('css')
    <style type="text/css" media="screen">
        .card-box {
            background: #fff;
            margin-bottom: 5px;
            padding: 20px;
            border-radius: 10px;
        }
        .card-box h5 {
            text-transform: none;
            font-weight: normal;
            line-height: 30px;
            font-size: 18px;
        }
        .card-box h5:hover {
            color: #2a92d0;
        }
        .bai-lien-quan ul {
            list-style-type: square;
        }
        .bai-lien-quan ul li a {
            font-size: 18px;
            line-height: 26px;
            font-weight: 400;
        }

        .chi-tiet, .chi-tiet p {
            font-size: 18px;
            line-height: 26px;
            font-weight: 400;
            margin-bottom:10px;
            text-align: justify;
        }
        .row {
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('body')
{{-- @include('Frontend.widget_banner') --}}
<section class="news-wrapper padding-xs">
    <div class="container chi-tiet">
        <div class="row">
          <div class="col-12 col-md-12">
            <h3 style="padding-bottom:20px;"><i class="fa fa-snowflake-o"></i> {{ __('Chi tiết nhiệm vụ KH&CN') }}</h3>
            <div class="card-box">
                    @if($ds['ma_so_nhiem_vu'])
                    <div class="row">
                        <div class="col-md-3">{{ __('Mã số nhiệm vụ') }}:</div>
                        <div class="col-md-9">{{ $ds['ma_so_nhiem_vu'] }}</div>
                    </div>
                    @endif
                    @if($ds['so_dang_ky_ket_qua'])
                    <div class="row">
                        <div class="col-md-3">{{ __('Số đăng ký kết quả') }}:</div>
                        <div class="col-md-9">{{ $ds['so_dang_ky_ket_qua'] }}</div>
                    </div>
                    @endif
                    @if($ds['ten_nhiem_vu'])
                    <div class="row">
                        <div class="col-md-3">{{ __('Tên nhiệm vụ') }}:</div>
                        <div class="col-md-9">{{ $ds['ten_nhiem_vu'] }}</div>
                    </div>
                    @endif
                    @if($ds['to_chuc_chu_tri'])
                    <div class="row">
                        <div class="col-md-3">{{ __('Cơ quan chủ trì') }}:</div>
                        <div class="col-md-9">{{ $ds['to_chuc_chu_tri'] }}</div>
                    </div>
                    @endif
                    @if($ds['co_quan_chu_quan'])
                    <div class="row">
                        <div class="col-md-3">{{ __('Cơ quan chủ quản') }}:</div>
                        <div class="col-md-9">{{ $ds['co_quan_chu_quan'] }}</div>
                    </div>
                    @endif
                    @if($ds['cap_quan_ly'])
                    <div class="row">
                        <div class="col-md-3">{{ __('Cấp quản lý') }}:</div>
                        <div class="col-md-9">{{ $ds['cap_quan_ly'] }}</div>
                    </div>
                    @endif
                    @if($ds['chu_nhiem_nhiem_vu'])
                    <div class="row">
                        <div class="col-md-3">{{ __('Chủ nhiệm Nhiệm vụ') }}:</div>
                        <div class="col-md-9">{{ $ds['chu_nhiem_nhiem_vu'] }}</div>
                    </div>
                    @endif
                    @if($ds['cac_thanh_vien_tham_gia'])
                        <div class="row">
                            <div class="col-md-3">{{ __('Các thành viên tham gia') }}:</div>
                            <div class="col-md-9">{{ $ds['cac_thanh_vien_tham_gia'] }}</div>
                        </div>
                    @endif
                    @if($ds['linh_vuc_nghien_cuu'])
                    <div class="row">
                        <div class="col-md-3">{{ __('Lĩnh vực nghiên cứu') }}:</div>
                        <div class="col-md-9">{{ $ds['linh_vuc_nghien_cuu'] }}</div>
                    </div>
                    @endif
                    @if(isset($ds['thoi_gian_thuc_hien']) && $ds['thoi_gian_thuc_hien'])
                    <div class="row">
                        <div class="col-md-3">{{ __('Thời gian thực hiện') }}:</div>
                        <div class="col-md-9">{{ $ds['thoi_gian_thuc_hien'] }}</div>
                    </div>
                    @endif
                    @if($ds['so_trang'])
                        <div class="row">
                            <div class="col-md-3">{{ __('Số trang') }}:</div>
                            <div class="col-md-9">{{ $ds['so_trang'] }}</div>
                        </div>
                    @endif
                    @if($ds['tom_tat'])
                        <div class="row">
                            <div class="col-md-3">{{ __('Tóm tắt') }}:</div>
                            <div class="col-md-9">{!! $ds['tom_tat'] !!}</div>
                        </div>
                    @endif
                    @if($ds['tu_khoa'])
                        <div class="row">
                            <div class="col-md-3">{{ __('Từ khóa') }}:</div>
                            <div class="col-md-9">{{ $ds['tu_khoa'] }}</div>
                        </div>
                    @endif
            </div>
            <br />
            <h3 style="padding-bottom:20px;"><i class="fa fa-snowflake-o"></i> {{ __('Xem thêm') }}</h3>
            <div class="card-box">
                <div class="row">
                    <div class="col-md-12 bai-lien-quan">
                        @if($danhsach)
                        <ul>
                        @foreach($danhsach as $lds)
                            <li>
                                <a href="{{ env('APP_URL').app()->getLocale() }}/nhiem-vu-khoa-hoc-cong-nghe/{{ $lds['slug'] }}">
                                    {{ $lds['ten_nhiem_vu'] }}
                                </a>
                            </li>
                        @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript">
  $(document).ready(function() {
  $("#owl-demo").owlCarousel({
      autoPlay: 3000,
      items : 1,
      center:true,
      loop: true
  });
});
</script>
@endsection
