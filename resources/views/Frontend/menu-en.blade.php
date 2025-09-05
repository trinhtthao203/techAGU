@php
$path = App\Http\Controllers\TranslatePathController::getPath(Request::path());
$locale = app()->getLocale();
if($path) {
if($locale == 'vi'){
$path_vi = env('APP_URL') . Request::path();
$path_en = env('APP_URL') . $path;
} else {
$path_en = env('APP_URL') . Request::path();
$path_vi = env('APP_URL') . $path;
}
} else {
$path_vi = env('APP_URL') . 'vi';
$path_en = env('APP_URL') . 'en';
}
$tags_dao_tao = App\Http\Controllers\DaoTaoController::get_tags();
$tags_khoa_luan=App\Http\Controllers\KhoaLuanTotNghiepController::get_tags();
$tags_nghien_cuu_khoa_hoc=App\Http\Controllers\NghienCuuKhoaHocController::get_tags();
$cats_catelory=App\Http\Controllers\CategoryController::get_cats();
$list_dtdh=App\Http\Controllers\DaoTaoController::get_list_dh_en();
$list_dtts=App\Http\Controllers\DaoTaoController::get_list_ts_en();
@endphp
<header>
    <div class="header-top">
        <div class="container clearfix">
            <div class="right-block clearfix">
                <ul class="top-nav" style="margin-left:0px;">
                    <li><a href="#" onclick="return false;" class="search"><i class="fa fa-search"></i></a></li>
                    <!-- @if(app()->getLocale() == 'vi')
                        <li><a href="{{ $path_en }}" title="{{ __('English') }}">{{ __('EN') }}</a></li>
                    @endif
                    @if(app()->getLocale() == 'en')
                        <li><a href="{{ $path_vi }}" title="{{ __('Tiếng Việt') }}">{{ __('VI') }}</a></li>
                    @endif -->
                    @if(app()->getLocale() == 'vi')
                    <li>
                        <a href="{{ $path_en }}" title="{{ __('English') }}">
                            EN<img src="{{ asset('assets/frontend/images/icon_en.png') }}" alt="English" style="width:20px; height:auto; margin-left:5px;">
                        </a>
                    </li>
                    @endif
                    @if(app()->getLocale() == 'en')
                    <li>
                        <a href="{{ $path_vi }}" title="{{ __('Tiếng Việt') }}">
                            VI <img src="{{ asset('assets/frontend/images/icon_vi.png') }}" alt="Tiếng Việt" style="width:20px; height:auto; margin-left:5px;">
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- Start Header Middle -->
    <div class="container header-middle">
        <div class="row">
            <span class="col-xs-7 col-md-4 col-sm-8">
                <a href="{{ env('APP_URL').app()->getLocale()  }}">
                    <img src="{{ env('APP_URL') }}assets/frontend/images/logo_{{ app()->getLocale() }}.png" class="" alt="Trung tâm Nghiên cứu Xã hội và Nhân văn Trường Đại học An Giang" title="Trung tâm Nghiên cứu Xã hội và Nhân văn Trường Đại học An Giang" style="width:120%;">
                </a>
            </span>
            <div class="col-xs-5 col-md-8 col-sm-7" id="SearchForm">
                <div class="contact clearfix">
                    <form action="{{ env('APP_URL').app()->getLocale() }}/search" method="GET" class="navbar-form navbar-right">
                        <input type="text" name="q" id="q" value="{{ isset($q) ? $q : '' }}" placeholder="{{ __('Search') }}" class="form-control" required>
                        <button class="search-btn"><span class="icon-search-icon"></span></button>
                    </form>
                    {{-- <ul>
            <li class="hidden-xs"><span>Email</span> <a href="mailto:shrc@agu.edu.vn">shrc@agu.edu.vn</a> </li>
            <li><span class="hidden-xs">Hotline</span><a href="tel:02963943695">02963.943.695</a></li>
          </ul>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Middle -->
    <!-- Start Navigation -->
    <nav class="navbar navbar-inverse" style="background:#037367;">
        <div class="container">
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
                {{-- <form class="navbar-form navbar-right">
          <input type="text" placeholder="Tìm kiếm" class="form-control">
          <button class="search-btn"><span class="icon-search-icon"></span></button>
        </form> --}}
                <ul class="nav navbar-nav">
                    <li class="dropdown"><a data-toggle="dropdown" href="#">{{ __('Giới thiệu') }} <i class="fa fa-angle-down" style="color:#fff;" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/overview">{{ __('Tổng quan') }}</a></li>
                            <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/personnel/faculty-leaders">{{ __('Ban Lãnh đạo khoa') }}</a></li>
                            <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/personnel/faculty-office">{{ __('Văn phòng khoa') }}</a></li>
                            <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/personnel/department-of-food-technology">{{ __('Bộ môn Công nghệ kỹ thuật môi trường') }}</a></li>
                            <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/personnel/department-of-aquaculture">{{ __('Bộ môn Quản lý tài nguyên và môi trường') }}</a></li>
                            <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/personnel/department-of-biotechnology">{{ __('Bộ môn Công nghệ kỹ thuật hóa học') }}</a></li>
                            <!-- <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/personnel/department-of-animal-husbandry-and-veterinary-medicine">{{ __('Bộ môn Chăn nuôi Thú y') }}</a></li>
                            <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/personnel/department-of-crop-science">{{ __('Bộ môn Khoa học Cây trồng') }}</a></li>
                            <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/personnel/department-of-rural-development-and-natural-resource-management">{{ __('Bộ môn Phát triển Nông thôn và QLTNTN')}} </a></li> -->
                        </ul>
                    </li>
                    <!--<li class="dropdown"><a href="#"  data-toggle="dropdown" >{{ __('Tin tức') }} <i class="fa fa-angle-down" style="color:#fff;" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="fonta"  href="{{ env('APP_URL') }}{{ app()->getLocale() }}/category/all">{{ __('Tất cả tin tức') }}</a></li>
                            <li><a class="fonta"  href="{{ env('APP_URL') }}{{ app()->getLocale() }}/category/announcement">{{ __('Thông báo') }}</a></li>
                            <li><a class="fonta"  href="{{ env('APP_URL') }}{{ app()->getLocale() }}/category/events">{{ __('Sự kiện') }}</a></li>
                            <li><a class="fonta"  href="{{ env('APP_URL') }}{{ app()->getLocale() }}/category/scientific-research">{{ __('Nghiên cứu khoa học') }}</a></li>
                            <li><a class="fonta"  href="{{ env('APP_URL') }}{{ app()->getLocale() }}/activities-image">{{ __('Hình ảnh hoạt động') }}</a></li>
                        </ul>
                    </li>-->
                    <li class="dropdown"><a href="#" data-toggle="dropdown">{{ __('Đào tạo') }} <i class="fa fa-angle-down" style="color:#fff;" aria-hidden="true"></i></a>
                        <!-- <ul class="dropdown-menu">
                            <li><a class="fontli" >{{ __('Đại học') }}</a></li>
                                <ul>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/training/university-programs/food-technology"> {{ __('Công nghệ thực phẩm') }}</a></li>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/training/university-programs/ensuring-quality-&-food-safety">{{ __('Đảm bảo chất lượng & ATVSTP') }}</a></li>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/training/university-programs/aquaculture">{{ __('Nuôi trồng Thuỷ sản')  }}</a></li>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/training/university-programs/biotechnology">{{ __('Công nghệ Sinh học') }}</a></li>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/training/university-programs/breed">{{ __('Chăn nuôi') }}</a></li>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/training/university-programs/veterinary-medicine">{{ __('Thú y') }}</a></li>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/training/university-programs/crop-science">{{ __('Khoa học Cây trồng') }}</a></li>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/training/university-programs/plant-protection">{{ __('Bảo vệ Thực vật') }}</a></li>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/training/university-programs/rural-development-&-natural-resource-management">{{ __('Phát triển Nông thôn & QLTNTN') }}</a></li>
                                </ul>
                            <li><a class="fontli">{{ __('Thạc sỹ') }}</a></li>
                                <ul >
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/training/masters-programs/breed">{{ __('Chăn nuôi') }}</a></li>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/training/masters-programs/crop-science">{{ __('Khoa học Cây trồng') }}</a></li>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/training/masters-programs/food-technology">{{ __('Công nghệ thực phẩm') }}</a></li>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/training/masters-programs/biotechnology">{{ __('Công nghệ Sinh học') }}</a></li>
                                </ul>
                        </ul> -->
                        <ul class="dropdown-menu">
                            <li><a class="fontli">{{ __('Đại học') }}</a></li>
                            <ul>
                                @foreach($list_dtdh as $ds)
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/training/university-programs/{{$ds['slug']}}">{{$ds['ten']}}</a></li>
                                @endforeach
                            </ul>
                            <li><a class="fontli">{{ __('Thạc sỹ') }}</a></li>
                            <ul>
                                @foreach($list_dtts as $ds)
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/training/masters-programs/{{$ds['slug']}}">{{$ds['ten']}}</a></li>
                                @endforeach
                            </ul>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown">{{ __('Nghiên cứu khoa học') }} <i class="fa fa-angle-down" style="color:#fff;" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="fontli">{{ __('Giảng viên') }}</a></li>
                            <ul>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/scientific-research/elementary-level-topic">{{ __('Đề tài cấp Cơ sở') }}</a></li>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/scientific-research/school-level-topic">{{ __('Đề tài cấp Trường') }}</a></li>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/scientific-research/provincial-level-topic">{{ __('Đề tài cấp Tỉnh') }}</a></li>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/scientific-research/national-university-level-topic">{{ __('Đề tài cấp ĐHQG') }}</a></li>
                            </ul>
                            <li><a class="fontli">{{ __('Sinh viên') }}</a></li>
                            <ul>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/graduation-thesis/graduation-thesis">{{ __('Khóa luận tốt nghiệp') }}</a></li>
                                <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/graduation-thesis/thesis">{{ __('Chuyên đề tốt nghiệp') }}</a></li>
                            </ul>
                        </ul>
                    </li>
                    <!-- <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/category/qa" >{{ __('Đảm bảo chất lượng') }}</a></li> -->
                    <li class="dropdown"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/category/international-cooperation">{{ __('Đối ngoại') }}</a></li>
                    <li class="dropdown"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/category/news">{{ __('Tin tức - Sự kiện') }}</a></li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown">{{ __('Văn bản - Biểu mẫu') }} <i class="fa fa-angle-down" style="color:#fff;" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="fontla" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/document">{{ __('Văn bản') }}</a></li>
                            <li><a class="fontla" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/form">{{ __('Biểu mẫu') }}</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown">{{ __('Liên Kết') }} <i class="fa fa-angle-down" style="color:#fff;" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="fontla" target="_blank" href="https://cpv.agu.edu.vn/">{{ __('Công tác Đảng') }}</a></li>
                            <li><a class="fontla" target="_blank" href="https://youth.agu.edu.vn/">{{ __('Đoàn Thanh niên') }}</a></li>
                            <li><a class="fontla" target="_blank" href="https://union.agu.edu.vn/">{{ __('Công đoàn') }}</a></li>
                            <li><a class="fontla" target="_blank" href="https://lib.agu.edu.vn/">{{ __('Thư Viện') }}</a></li>
                            <li><a class="fontla" target="_blank" href="https://www.facebook.com/dkktcnmtruong/">{{ __('Đoàn khoa KT-CN-MT') }}</a></li>
                        </ul>
                    </li>
                    <!-- <li class="dropdown"><a  data-toggle="dropdown" href="">Research <i class="fa fa-angle-down" style="color:#fff;" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                        <li><a href="{{ env('APP_URL') }}en/science-and-technology-misson">Science and Technology misson</a></li>
                        <li><a href="{{ env('APP_URL') }}en/projects">Projects</a></li>
                        <li><a href="{{ env('APP_URL') }}en/scientific-publication">Scientific Publication</a></li>
                        <li><a href="{{ env('APP_URL') }}en/documents">Documents</a></li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
        <!-- End Navigation -->
</header>