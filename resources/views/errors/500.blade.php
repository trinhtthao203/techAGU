@extends('Frontend.layout')
@section('title', '404')
@section('body')
<div class="inner-banner blog">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="content">
          <h1>{{__('Không tìm thấy kết quả')}}</h1>
         <a  href="{{ env('APP_URL') }}{{ app()->getLocale() }}"  <p>{{__('Trở về')}}</p></a>
        </div>
      </div>
    </div>
  </div>
</div>
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