<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" type="image/x-icon" href="{{ env('APP_URL') }}assets/frontend/images/favicon.png">
<title> @yield('title') | {{ __('Khoa Nông nghiệp & TNTN') }}</title>
<meta property="og:url"           content="{{ Request::fullUrl() }}" />
<meta property="og:type"          content="{{ __('Khoa Nông nghiệp & TNTN') }}" />
<meta property="og:title"         content="@yield('title', __('Khoa Nông nghiệp & TNTN'))" />
<meta property="og:description"   content="@yield('description' , __('Khoa Nông nghiệp & TNTN là đơn vị sự nghiệp trực thuộc Trường Đại học An Giang.'))" />
<meta property="og:image"         content="@yield('image', 'https://shrc.agu.edu.vn/assets/frontend/images/logo.jpg')" />
<!-- Reset CSS -->
<link href="{{ env('APP_URL') }}assets/frontend/css/reset.css" rel="stylesheet" type="text/css">
<!-- Bootstrap -->
<link href="{{ env('APP_URL') }}assets/frontend/libs//bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<!-- Select2 -->
<link href="{{ env('APP_URL') }}assets/frontend/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">
<!-- Font Awesome -->
<link href="{{ env('APP_URL') }}assets/frontend/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- Magnific Popup -->
<link href="{{ env('APP_URL') }}assets/frontend/libs/magnific-popup/css/magnific-popup.css" rel="stylesheet" type="text/css">
<!-- Iconmoon -->
<link href="{{ env('APP_URL') }}assets/frontend/libs/iconmoon/css/iconmoon.css" rel="stylesheet" type="text/css">
<!-- Owl Carousel -->
<link href="{{ env('APP_URL') }}assets/frontend/libs/owl-carousel/css/owl.carousel.min.css" rel="stylesheet" type="text/css">
<!-- Animate -->
<link href="{{ env('APP_URL') }}assets/frontend/css/animate.css" rel="stylesheet" type="text/css">

<!-- Custom Style -->
{{-- <link href="{{ env('APP_URL') }}assets/frontend/css/fonts_google.css" rel="stylesheet" type="text/css"> --}}
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
<link href="{{ env('APP_URL') }}assets/frontend/css/custom.css" rel="stylesheet" type="text/css">
<link href="{{ env('APP_URL') }}assets/frontend/css/owl.carousel.css" rel="stylesheet">
<link href="{{ env('APP_URL') }}assets/frontend/css/owl.theme.css" rel="stylesheet">


<style>
  .centered-text {
    text-align: center;
    margin-top: 2px;
    background-color: #06b429; /* Đặt màu nền cho div */
    padding: 10px; /* Thêm padding cho div để tạo khoảng cách với nội dung */

  }
  .centered-text span {
    font-size: 28px;
    color: white;
  }

  @media only screen and (max-width: 768px) {
    /* Điều chỉnh kích thước cho các thiết bị di động */
    .centered-text span {
      font-size: 18px; /* Đặt kích thước phù hợp với màn hình di động */
    }
  }
</style>
@section('css') @show
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="{{ env('APP_URL') }}assets/frontend/js/html5shiv.min.js"></script>
      <script src="{{ env('APP_URL') }}assets/frontend/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="fb-root"></div>
{{-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0&appId=131376384294659&autoLogAppEvents=1" nonce="b8K2qHOU"></script> --}}
<!-- Start Preloader -->
<div id="loading">
  <div class="element">
    <div class="sk-folding-cube">
      <div class="sk-cube1 sk-cube"></div>
      <div class="sk-cube2 sk-cube"></div>
      <div class="sk-cube4 sk-cube"></div>
      <div class="sk-cube3 sk-cube"></div>
    </div>
  </div>
</div>
<!-- End Preloader -->
<!-- Start Header -->
@include('Frontend.menu-'.app()->getLocale())
<!-- End Header -->
@section('body') @show
<!-- End Header -->
<!-- Start Footer -->
<div style="color: #fff; height:40px"></div>
<footer class="footer">
  <!-- Start Footer Bottom -->
  <div class="bottom" style="background:#058B3C;">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-5 clearfix">
            <h3 style="padding-bottom:5px;color:#fff;">{{ __('KHOA NÔNG NGHIỆP TÀI NGUYÊN THIÊN NHIÊN') }}</h3> 
            <p><i class="fa fa-map-marker"></i> <a href="{{ env('APP_URL') }}vi/lien-he" style="color:#fff;">{{ __('Số 18, đường Ung Văn Khiêm, phường Long Xuyên, tỉnh An Giang') }}</a></p>
            <p><i class="fa fa-envelope"></i> <a href="mailto:agri@agu.edu.vn" style="color:#fff;">agri@agu.edu.vn</a></p>
            <p><i class="fa fa-phone" aria-hidden="true" style="font-size:17px;"></i> <a href="tel:02963943695" style="color:#fff;">02963.943.695</a></p>
          </div>
      </div>
    </div>
  </div>
  <div>
  <!-- End Footer Bottom -->
</footer>
<!-- End Footer -->
<!-- Scroll to top -->
<a href="#" class="scroll-top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/js/jquery.min.js"></script>
<!-- Bootsrap JS -->
<script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 JS -->
<script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/select2/js/select2.min.js"></script>
<!-- Match Height JS -->
<script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/matchHeight/js/matchHeight-min.js"></script>
<!-- Bxslider JS -->
<script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/bxslider/js/bxslider.min.js"></script>
<!-- Waypoints JS -->
<script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/waypoints/js/waypoints.min.js"></script>
<!-- Counter Up JS -->
<script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/counterup/js/counterup.min.js"></script>
<!-- Magnific Popup JS -->
<script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/magnific-popup/js/magnific-popup.min.js"></script>
<script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/isotope/js/isotope.min.js"></script>
<!-- Owl Carousal JS -->
<script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/owl-carousel/js/owl.carousel.min.js"></script>
<!-- Modernizr JS -->
<script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/js/modernizr.custom.js"></script>
<!-- Custom JS -->
<script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/js/custom.js"></script>
<script src="{{ env('APP_URL') }}assets/frontend/js/owl.carousel.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
    $("#SearchForm").hide();
    $(".search").click(function(){
      $("#SearchForm").slideToggle();
    });
  });
</script>
@section('js') @show
</body>
</html>
