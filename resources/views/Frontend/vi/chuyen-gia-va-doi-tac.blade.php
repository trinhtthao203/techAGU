@extends('Frontend.layout')
@section('title', 'Giới thiệu - Chuyên gia và Đối tác')
@section('body')
@include('Frontend.widget_banner')
<section class="testimonial-outer padding-lg">
    <div class="container">
        <h3 >Chuyên gia và Đối tác</h3>
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
