<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title') | {{ __("Khoa Nông nghiệp & TNTN") }} - {{ __("AGU") }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{ __("Khoa Nông nghiệp & TNTN") }} - {{ __("AGU") }}" name="description" />
        <meta content="Phan Minh Trung - trungminhphan@gmail.com" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ env('APP_URL') }}assets/backend/images/favicon.ico">
        @section('css') @show
        <!-- App css -->
        <link href="{{ env('APP_URL') }}assets/backend/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ env('APP_URL') }}assets/backend/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ env('APP_URL') }}assets/backend/css/app.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ env('APP_URL') }}assets/backend/css/style.css" rel="stylesheet" type="text/css" />
        
    </head>
    <body>
        <!-- Navigation Bar-->
        <header id="topnav" style="background-color:#0072c6;">
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">
                        <li class="dropdown notification-list">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown d-none d-lg-block">
                            <a class="nav-link dropdown-toggle mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ app()->getLocale() }}.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">{{ $arr_lang[app()->getLocale()] }} <i class="mdi mdi-chevron-down"></i> </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                @foreach($arr_lang as $klang => $vlang)
                                @php
                                    $id = isset($id) ? $id : App\Http\Controllers\ObjectController::Id();
                                    $link = route(\Illuminate\Support\Facades\Route::currentRouteName(), array($klang, $id));
                                @endphp
                                    <a href="{{ $link }}" class="dropdown-item notify-item">
                                        <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">{{ $vlang }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </li>
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ env('APP_URL') }}assets/backend/images/logo-sm.png" alt="{{ Session::get('user.name') }}" alt="{{ Session::get('user.username') }}" class="rounded-circle">
                                <span class="pro-user-name ml-1">{{ Session::get('user.username') }}<i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>
                                @if(Session::get('user.roles') && in_array('Admin', Session::get('user.roles')))
                                <a href="{{ env('APP_URL') . app()->getLocale() }}/admin/user" class="dropdown-item notify-item">
                                    <i class="fe-user"></i> <span>{{ __("Accounts") }}</span>
                                </a>
                                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate" class="dropdown-item notify-item">
                                    <i class="fas fa-language"></i> <span>{{ __('Translate') }}</span>
                                </a>
                                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate-path" class="dropdown-item notify-item">
                                    <i class="fas fa-code-branch"></i> <span>{{ __('Translate Path') }}</span>
                                </a>
                                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/log" class="dropdown-item notify-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
  <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
  <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
  <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
</svg><span>  {{ __('Lịch sử') }}</span>
                                </a>
                                @endif
                                <a href="{{ env('APP_URL') . app()->getLocale() }}/auth/logout" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i> <span>{{ __("Logout") }}</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="{{ env('APP_URL') }}admin" class="logo text-center">
                            <span class="logo-lg">
                                <img src="{{ env('APP_URL') }}assets/backend/images/logo_{{ app()->getLocale() }}.jpg" title="{{ __("ĐẠI HỌC QUỐC GIA TPHCM TRƯỜNG ĐẠI HỌC AN GIANG") }} - {{ __("AGU") }}" height="40">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ env('APP_URL') }}assets/backend/images/logo-sm.png" alt="" height="26">
                            </span>
                        </a>
                    </div>
                </div> <!-- end container-fluid-->
            </div>
            <!-- end Topbar -->
            <div class="topbar-menu">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li class="has-submenu"> <a href="#"><i class="far fa-file-alt"></i> {{ __('Hình ảnh - Banner') }} <div class="arrow-down"></div> </a>
                                <ul class="submenu">
                                    <li><a href="{{ env('APP_URL') . app()->getLocale() }}/admin/banner"><i class="far fa-images"></i> {{ __('Banner') }}</a></li>
                                    <li><a href="{{ env('APP_URL') . app()->getLocale() }}/admin/hinh-anh-hoat-dong"><i class="far fa-images"></i> {{ __('Hình ảnh hoạt động') }}</a></li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar-reverse" viewBox="0 0 16 16">
  <path d="M12.5 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zm0 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zm.5 3.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
  <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM4 1v14H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm1 0h9a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5z"/>
</svg> {{ __('Giới thiệu') }} <div class="arrow-down"></div> </a>
                                <ul class="submenu">
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/tong-quan">{{ __('Tổng quan') }}</a></li>
                                    <!-- <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/nhan-su">{{ __('Nhân sự') }}</a></li> -->
                                    {{-- <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/chuyen-gia">{{ __('Chuyên gia') }}</a></li> --}}
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/lien-he">{{ __('Liên hệ') }}</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
  <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5"/>
  <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z"/>
</svg>      {{ __('Nhân sự') }} <div class="arrow-down"></div> </a>
                                <ul class="submenu">
                                    
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/ban-lanh-dao-khoa">{{ __('Ban Lãnh đạo khoa') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/van-phong-khoa">{{ __('Văn phòng khoa') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/bo-mon-cong-nghe-thuc-pham">{{ __('Bộ môn Công nghệ Thực phẩm') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/bo-mon-nuoi-trong-thuy-san">{{ __('Bộ môn Nuôi trồng Thủy sản') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/bo-mon-cong-nghe-sinh-hoc">{{ __('Bộ môn Công nghệ Sinh học') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/bo-mon-chan-nuoi-thu-y">{{ __('Bộ môn Chăn nuôi Thú y') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/bo-mon-khoa-hoc-cay-trong">{{ __('Bộ môn Khoa học Cây trồng') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/bo-mon-phat-trien-nong-thon-va-qltntn">{{ __('Bộ môn Phát triển Nông thôn và QLTNTN') }}</a></li>  
                                </ul>
                            </li>
                            <!-- <li >
                                <a href="{{ env('APP_URL') . app()->getLocale() }}/admin/tin-tuc-su-kien">{{ __('Tin tức - Sự kiện') }}</a>
    
                            </li> -->
                            <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/category"><i class="far fa-newspaper"></i> {{ __('Bài viết') }}</a></li>
                            <li>
                                <a href="{{ env('APP_URL') . app()->getLocale() }}/admin/dao-tao"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg> {{ __('Đào tạo') }}</a>
                            </li>
                        
                            <li class="has-submenu">
                                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg></i> {{ __('Nghiên cứu') }} <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nghien-cuu-khoa-hoc">{{ __('Nghiên cứu khoa học') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/khoa-luan-tot-nghiep">{{ __('Khóa luận tốt nghiệp') }}</a></li>
                                    <!-- <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/du-an">{{ __('Dự án') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/hoi-nghi-hoi-thao">{{ __('Hội nghị - Hội thảo') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/doi-tac">{{ __('Đối tác') }}</a></li> -->
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fab fa-xbox"></i> {{ __('Văn bản - Biểu mẫu') }} <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/van-ban">{{ __('Văn bản') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/bieu-mau">{{ __('Biểu mẫu') }}</a></li>
                                </ul>
                            </li
                        </ul>
                        <!-- End navigation menu -->
                        <div class="clearfix"></div>
                    </div>
                    <!-- end #navigation -->
                </div>
                <!-- end container -->
            </div>
            <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container-fluid">
                <!-- start page title -->
                @section('body') @show
            </div>
        </div>
        <!-- end wrapper -->
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
          <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 text-center">
                        &copy; 2023 {{ __('Đại học Quốc gia TPHCM Trường Đại học An Giang') }}
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
        <!-- Vendor js -->
        <script src="{{ env('APP_URL') }}assets/backend/js/vendor.min.js"></script>
        @section('js') @show
        <!-- App js -->
        <script src="{{ env('APP_URL') }}assets/backend/js/app.min.js"></script>
    </body>
</html>
