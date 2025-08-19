@extends('Frontend.layout')
@section('title', __($ds['ten_du_an']))
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
        ul.bai-lien-quan {
            list-style-type: square;
        }
        ul.bai-lien-quan li a {
            font-size: 18px;
            line-height: 26px;
            font-weight: 400;
        }
        .chi-tiet-du-an, .chi-tiet-du-an p {
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
    <div class="container chi-tiet-du-an">
        <div class="row">
          <div class="col-12 col-md-12">
            <h3 style="padding-bottom:20px;"><i class="fa fa-envira"></i> {{ __('Chi tiết Thông tin Dự án') }}</h3>
            <div class="card-box">
                @if($ds['ten_du_an'])
                <div class="row">
                    <div class="col-md-3">{{ __('Tên dự án') }}:</div>
                    <div class="col-md-9">{{ $ds['ten_du_an'] }}</div>
                </div>
                @endif
                @if(isset($ds['co_quan_chu_tri']) && $ds['co_quan_chu_tri'])
                <div class="row">
                    <div class="col-md-3">{{ __('Cơ quan chủ trì') }}:</div>
                    <div class="col-md-9">{{ $ds['co_quan_chu_tri'] }}</div>
                </div>
                @endif
                @if(isset($ds['co_quan_chu_quan']) && $ds['co_quan_chu_quan'])
                <div class="row">
                    <div class="col-md-3">{{ __('Cơ quan chủ quản') }}:</div>
                    <div class="col-md-9"><b>{{ $ds['co_quan_chu_quan'] }}</b></div>
                </div>
                @endif
                @if($ds['don_vi_tai_tro'])
                <div class="row">
                    <div class="col-md-3">{{ __('Đơn vị tài trợ') }}:</div>
                    <div class="col-md-9">{{ $ds['don_vi_tai_tro'] }}</div>
                </div>
                @endif
                @if(isset($ds['kinh_phi_tai_tro']) && $ds['kinh_phi_tai_tro'])
                <div class="row">
                    <div class="col-md-3">{{ __('Kinh phí tài trợ') }}:</div>
                    <div class="col-md-9">{{ $ds['kinh_phi_tai_tro'] }}</div>
                </div>
                @endif
                @if($ds['can_bo_du_an'])
                <div class="row">
                    <div class="col-md-3">{{ __('Cán bộ dự án') }}:</div>
                    <div class="col-md-9">{{ $ds['can_bo_du_an'] }}</div>
                </div>
                @endif
                @if($ds['thoi_gian_thuc_hien'])
                <div class="row">
                    <div class="col-md-3">{{ __('Thời gian thực hiện') }}:</div>
                    <div class="col-md-9">{{ $ds['thoi_gian_thuc_hien'] }}</div>
                </div>
                @endif
                @if($ds['noi_dung_hoat_dong'])
                <div class="row">
                    <div class="col-md-3">{{ __('Nội dung hoạt động') }}:</div>
                    <div class="col-md-9">{!! $ds['noi_dung_hoat_dong'] !!}</div>
                </div>
                @endif
            </div>
            <br />
            <h3 style="padding-bottom:20px;"><i class="fa fa-envira"></i> {{ __('Bài viết liên quan') }}</h3>
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            @if($danhsach)
                            <ul class="bai-lien-quan">
                            @foreach($danhsach as $lds)
                                <li>
                                    <a href="{{ env('APP_URL').app()->getLocale() }}/du-an/{{ $lds['slug'] }}">
                                        {{ $lds['ten_du_an'] }}
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
