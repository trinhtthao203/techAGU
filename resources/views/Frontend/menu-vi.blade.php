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
  $list_dtdh=App\Http\Controllers\DaoTaoController::get_list_dh();
  $list_dtts=App\Http\Controllers\DaoTaoController::get_list_ts();
@endphp
<header>
  <div class="header-top">
    <div class="container clearfix">
      <div class="right-block clearfix">
        <ul class="top-nav" style="margin-left:0px;">
          <li><a href="#" onclick="return false;" class="search"><i class="fa fa-search"></i></a></li>
          @if(app()->getLocale() == 'vi')
            <!-- <li><a href="{{ $path_en }}" title="{{ __('English') }}">{{ __('EN ') }}</a></li> -->
             <li>
                <a href="{{ $path_en }}" title="{{ __('English') }}">
                EN<img src="{{ asset('assets/frontend/images/icon_en.png') }}" alt="English" style="width:20px; height:auto; margin-left:5px;">
                </a>
            </li>
          @endif
          @if(app()->getLocale() == 'en')
            <!-- <li><a href="{{ $path_vi }}" title="{{ __('Tiếng Việt') }}">{{ __('VI') }}</a></li> -->
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
        <a href="{{ env('APP_URL') }}">
          <img src="{{ env('APP_URL') }}assets/frontend/images/logo_{{ app()->getLocale() }}.png" class="" alt="{{ __('Trung tâm Nghiên cứu Xã hội và Nhân văn Trường Đại học An Giang') }}" title="{{ __('Trung tâm Nghiên cứu Xã hội và Nhân văn Trường Đại học An Giang') }}" style="width:120%;">
        </a>
      </span>

      <div class="col-xs-5 col-md-8 col-sm-7" id="SearchForm">
        <div class="contact clearfix">
          <form action="{{ env('APP_URL').app()->getLocale() }}/tim-kiem" method="GET" class="navbar-form navbar-right">
            <input type="text" name="q" id="q" value="{{ isset($q) ? $q : '' }}" placeholder="{{ __('Tìm kiếm') }}" class="form-control" required>
            <button class="search-btn"><span class="icon-search-icon"></span></button>
          </form>
          </div>
      </div>
    </div>
  </div>
  <!-- Start Navigation -->
  <nav class="navbar navbar-inverse" style="background:#037367;" >
    <div class="container">
      <div class="navbar-header">
        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="navbar-collapse collapse" id="navbar">
        <!-- <form class="navbar-form navbar-right">
          <input type="text" placeholder="Tìm kiếm" class="form-control">
          <button class="search-btn"><span class="icon-search-icon"></span></button>
        </form> -->
        <ul class="nav navbar-nav">
          <li class="dropdown"><a data-toggle="dropdown" href="#">{{ __('Giới thiệu') }} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tong-quan" >{{ __('Tổng quan') }}</a></li>
              <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/ban-lanh-dao-khoa">{{ __('Ban Lãnh đạo khoa') }}</a></li>
              <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/van-phong-khoa">{{ __('Văn phòng khoa') }}</a></li>
              <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/bo-mon-cong-nghe-thuc-pham">{{ __('Bộ môn Công nghệ kỹ thuật môi trường') }}</a></li>
              <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/bo-mon-nuoi-trong-thuy-san">{{ __('Bộ môn Quản lý tài nguyên và môi trường') }}</a></li>
              <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/bo-mon-cong-nghe-sinh-hoc">{{ __('Bộ môn Công nghệ kỹ thuật hóa học') }}</a></li>
            </ul>
          </li>
          <!--<li class="dropdown"><a href="#"  data-toggle="dropdown" >{{ __('Tin tức') }} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/category/thong-bao">{{ __('Thông báo') }}</a></li>
              <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/category/su-kien">{{ __('Sự kiện') }}</a></li>
              <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/hinh-anh-hoat-dong">{{ __('Hình ảnh hoạt động') }}</a></li>
            </ul>
          </li>-->
          <li class="dropdown"><a href="#"  data-toggle="dropdown" >{{ __('Đào tạo') }} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <!-- <ul class="dropdown-menu">
              <li><a class="fontli" >{{ __('Đại học') }}</a></li>
                <ul>
                  <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/dai-hoc/cong-nghe-thuc-pham"> Công nghệ thực phẩm</a></li>
                  <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/dai-hoc/dam-bao-chat-luong-va-attp">Đảm bảo chất lượng & ATVSTP</a></li>
                  <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/dai-hoc/nuoi-trong-thuy-san">Nuôi trồng Thuỷ sản</a></li>
                  <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/dai-hoc/cong-nghe-sinh-hoc">Công nghệ Sinh học</a></li>
                  <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/dai-hoc/chan-nuoi">Chăn nuôi</a></li>
                  <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/dai-hoc/thu-y">Thú y</a></li>
                  <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/dai-hoc/khoa-hoc-cay-trong">Khoa học Cây trồng</a></li>
                  <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/dai-hoc/bao-ve-thuc-vat">Bảo vệ Thực vật</a></li>
                  <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/dai-hoc/phat-trien-nong-thon-va-qltntn">Phát triển Nông thôn & QLTNTN</a></li>

                </ul>
              <li><a class="fontli">{{ __('Thạc sỹ') }}</a></li>
                <ul >
                  <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/thac-sy/chan-nuoi">Chăn nuôi</a></li>
                  <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/thac-sy/khoa-hoc-cay-trong">Khoa học Cây trồng</a></li>
                  <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/thac-sy/cong-nghe-thuc-pham">Công nghệ Thực phẩm</a></li>
                  <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/thac-sy/cong-nghe-sinh-hoc">Công nghệ Sinh học</a></li>
                </ul>
            </ul> -->
            <ul class="dropdown-menu">
              <li><a class="fontli" >{{ __('Đại học') }}</a></li>
                <ul>
                @foreach($list_dtdh as $ds)
                  <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/dai-hoc/{{$ds['slug']}}">{{$ds['ten']}}</a></li>
                @endforeach
                </ul>
              <li><a class="fontli">{{ __('Thạc sỹ') }}</a></li>
                <ul >
                @foreach($list_dtts as $ds)
                  <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/thac-sy/{{$ds['slug']}}">{{$ds['ten']}}</a></li>
                @endforeach
                </ul>
            </ul>
          </li>
          <li class="dropdown"><a href="#"  data-toggle="dropdown" >{{ __('Nghiên cứu khoa học') }} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              <li><a class="fontli" >{{ __('Giảng viên') }}</a></li>
                <ul>
                  @foreach($tags_nghien_cuu_khoa_hoc as $ktag => $tags)
                    <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nghien-cuu-khoa-hoc/{{ $ktag }}">{{ $tags}}</a></li>
                  @endforeach
                </ul>
              <li><a class="fontli">{{ __('Sinh viên') }}</a></li>
                <ul>
                  @foreach($tags_khoa_luan as $ktag => $tags)
                    <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/khoa-luan-tot-nghiep/{{ $ktag }}">{{ $tags}}</a></li>
                  @endforeach
                </ul>
            </ul>
          </li>
            <!-- <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/category/dam-bao-chat-luong" >{{ __('Đảm bảo chất lượng') }}</a>
          </li> -->

          <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/category/quan-he-doi-ngoai" >{{ __('Đối ngoại') }}</a>
          </li>
          <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/category/tin-tuc" >{{ __('Tin tức - Sự kiện') }}</a>
          <li class="dropdown"><a href="#"  data-toggle="dropdown" >{{ __('Văn bản - Biểu mẫu') }} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/van-ban">{{ __('Văn bản') }}</a></li>
              <li><a class="fonta" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/bieu-mau">{{ __('Biểu mẫu') }}</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"  data-toggle="dropdown" >{{ __('Liên kết') }} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              <li><a class="fonta" href="https://cpv.agu.edu.vn/">Công tác Đảng</a></li>
              <li><a class="fontla" href="https://youth.agu.edu.vn/">{{ __('Đoàn Thanh niên') }}</a></li>
              <li><a class="fontla" href="https://union.agu.edu.vn/">{{ __('Công đoàn') }}</a></li>
              <li><a class="fontla" href="https://lib.agu.edu.vn/">{{ __('Thư Viện') }}</a></li>
              <li><a class="fontla" href="https://www.facebook.com/dkktcnmtruong/">{{ __('Đoàn khoa KT-CN-MT') }}</a></li>
            </ul>
          </li>

          <!-- <li class="dropdown"><a  data-toggle="dropdown" href="">Research <i class="fa fa-angle-down" aria-hidden="true"></i></a>
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
  </nav>


</header>
