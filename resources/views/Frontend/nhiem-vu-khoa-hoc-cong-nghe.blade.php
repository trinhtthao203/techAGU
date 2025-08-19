@extends('Frontend.layout')
@section('title', __('Nghiệm vu Khoa học Công nghệ'))
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
            <h3 style="padding-bottom:20px;"><i class="fa fa-snowflake-o"></i> {{ __('Nhiệm vụ Khoa học Công nghệ') }}</h3>
            @foreach($danhsach as $ds)
            <div class="card-box">
                <a href="{{ env('APP_URL').app()->getLocale() }}/nhiem-vu-khoa-hoc-cong-nghe/{{ $ds['slug'] }}">
                    <div class="row">
                        <div class="col-md-2">{{ __('Tên nhiệm vụ') }}:</div>
                        <div class="col-md-10">{{ $ds['ten_nhiem_vu'] }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">{{ __('Chủ nhiệm Nhiệm vụ') }}:</div>
                        <div class="col-md-10">{{ $ds['chu_nhiem_nhiem_vu'] }}</div>
                    </div>
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
        {{ $danhsach->withPath(env('APP_URL').app()->getLocale().'/nhiem-vu-khoa-hoc-cong-nghe') }}
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
