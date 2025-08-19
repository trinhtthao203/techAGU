@extends('Frontend.layout')
@section('title', __('Công bố Khoa học'))
@section('css')
    <style type="text/css" media="screen">
        .card-box {
            background: #fff;
            margin-bottom: 5px;
            padding: 20px;
            border-radius: 10px;
            font-size: 18px;
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
        .row {
            margin-bottom: 7px;
        }
        .row div {
            line-height:26px;
        }
    </style>
@endsection
@section('body')
{{-- @include('Frontend.widget_banner') --}}
<section class="news-wrapper padding-xs">
    <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <h3 style="padding-bottom:20px;"><i class="fa fa-book" aria-hidden="true"></i> {{ __('Công bố Khoa học') }}</h3>
            @foreach($danhsach as $ds)
            <div class="card-box">
                <a href="{{ env('APP_URL').app()->getLocale() }}/cong-bo-khoa-hoc/{{ $ds['slug'] }}">
                    <div class="row">
                        <div class="col-md-2">{{ __('Nhan đề') }}:</div>
                        <div class="col-md-10">{{ $ds['nhan_de'] }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">{{ __('Tên tác giả') }}:</div>
                        <div class="col-md-10">{{ $ds['ten_tac_gia'] }}</div>
                    </div>
                    @if($ds['nguon_trich'])
                    <div class="row">
                        <div class="col-md-2">{{ __('Nguồn trích') }}:</div>
                        <div class="col-md-10">{{ $ds['nguon_trich'] }}</div>
                    </div>
                    @endif
                </a>
            </div>
            @endforeach
          </div>
        </div>
        <br />
        {{ $danhsach->withPath(env('APP_URL').app()->getLocale().'/cong-bo-khoa-hoc') }}
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
