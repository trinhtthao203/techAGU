@extends('Frontend.layout')
@section('title', 'Giới thiệu - Nhân sự')
@section('css')
<style type="text/css" media="screen">
  .noi-dung h2 {
    padding: 20px 0px;
    color: #27316b;
    margin-top: 10px;
    margin-bottom: 10px;
    text-align:center;
  }
</style>
@endsection
@section('body')
<section class="testimonial-outer">
  <div class="container noi-dung">
    <h2>{{ __('Organizational Structure') }}</h2>
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
    <br />
  </div>
</section>

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


