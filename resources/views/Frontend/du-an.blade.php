@extends('Frontend.layout')
@section('title', __('Dự án'))
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
    </style>
@endsection
@section('body')
{{-- @include('Frontend.widget_banner') --}}
<section class="news-wrapper padding-xs">
    <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <h3 style="padding-bottom:20px;"><i class="fa fa-envira"></i> {{ __('Dự án') }}</h3>
            @foreach($danhsach as $ds)
            <div class="card-box">
                <a href="{{ env('APP_URL').app()->getLocale() }}/du-an/{{ $ds['slug'] }}">
                    <div class="row">
                        <div class="col-md-2">{{ __('Tên dự án') }}:</div>
                        <div class="col-md-10">{{ $ds['ten_du_an'] }}</div>
                    </div>
                    @if($ds['don_vi_tai_tro'])
                    <div class="row">
                        <div class="col-md-2">{{ __('Đơn vị tài trợ') }}:</div>
                        <div class="col-md-10">{{ $ds['don_vi_tai_tro'] }}</div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-2">{{ __('Thời gian thực hiện') }}:</div>
                        <div class="col-md-10">{{ $ds['thoi_gian_thuc_hien'] }}</div>
                    </div>
                </a>
            </div>
            @endforeach
          </div>
        </div>
        <br />
        {{ $danhsach->withPath(env('APP_URL').app()->getLocale().'/du-an') }}
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
