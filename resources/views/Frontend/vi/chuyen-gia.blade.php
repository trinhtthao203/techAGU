@extends('Frontend.layout')
@section('title', 'Giới thiệu - Nhân sự')
@section('css')
<style type="text/css" media="screen">
  .noi-dung h2 {
    padding: 20px 0px;
    color: #27316b;
    margin-top: 10px;
    margin-bottom: 10px;
    text-align:center !important;
  }
  .v .items {
    padding: 20px 0px 20px 0px;
    border: 3px solid #2a92d0;
    margin-bottom: 20px;
    border-radius: 10px;
  }
  .noi-dung .items h3 {
    padding-bottom: 15px;
    text-transform: uppercase;
  }
  .noi-dung .items p {
    padding: 7px 0px 7px 0px;
  }
</style>
@endsection
@section('body')
<section class="about inner padding-lg">
  <div class="container noi-dung">
    <h2 style="text-align:center;">Chuyên gia</h2>
    @if($danhsach)
    @foreach($danhsach as $ds)
      @php
        $image = isset($ds['photos'][0]['aliasname'])  ? $ds['photos'][0]['aliasname'] : '';
      @endphp
        <div class="row items">
          <div class="col-12 col-md-12">
            @if($image)
              <img src="{{ env('APP_URL') }}storage/images/origin/{{ $image }}" class="img-responsive" title="{{ $ds['ho_ten'] }}" style="float:left;margin:0px 20px 20px 0px;">
            @endif
              <h3>{{ $ds['ho_ten'] }}</h3>
              @if($ds['chuc_vu'])
                <p>{{ __('Chức vụ') }}: {{ $ds['chuc_vu'] }}</p>
              @endif
              @if($ds['email'])
                <p>{{ __('Email') }}: <a href="mailto:{{ $ds['email'] }}">{{ $ds['email'] }}</a></p>
              @endif
              @if($ds['dien_thoai'])
                <p>{{ __('Điện thoại') }}: <a href="tel:{{ $ds['dien_thoai'] }}">{{ $ds['dien_thoai'] }}</a></p>
              @endif
              {!! $ds['mo_ta'] !!}
          </div>
        </div>
    @endforeach
    @endif
  </div>
</section>
{{-- <section class="testimonial-outer">
  <div class="container">
    <h2>Chuyên gia</h2>
    <hr />
    @if($danhsach)
    <ul class="row testimonials" style="position: relative;">
      @foreach($danhsach as $ds)
      @php
        $image = isset($ds['photos'][0]['aliasname'])  ? $ds['photos'][0]['aliasname'] : '';
      @endphp
      <li class="col-xs-6 col-sm-6 col-md-4 grid-item">
        <div class="quotblock">
          @if($image)
            <img src="{{ env('APP_URL') }}storage/images/origin/{{ $image }}" class="img-responsive" title="{{ $ds['ho_ten'] }}">
          @endif
          <h3>{{ $ds['ho_ten'] }}</h3>
          @if($ds['chuc_vu'])
            <span class="desig">{{ __('Chức vụ') }}: {{ $ds['chuc_vu'] }}</span>
          @endif
          @if($ds['email'])
            <span class="desig">{{ __('Email') }}: <a href="mailto:{{ $ds['email'] }}">{{ $ds['email'] }}</a></span>
          @endif
           @if($ds['dien_thoai'])
            <span class="desig">{{ __('Điện thoại') }}: <a href="tel:{{ $ds['dien_thoai'] }}">{{ $ds['dien_thoai'] }}</a></span>
          @else
            <span class="desig">&nbsp;</span>
          @endif
        </div>
      </li>
      @endforeach
    </ul>
    @endif

  </div>
</section>
 --}}
@endsection
@section('js')
<script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/masonry/js/masonry.min.js"></script>
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
