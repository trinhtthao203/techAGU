@extends('Frontend.layout')
@section('title', __($ds['nhan_de']))
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
        .bai-lien-quan ul {
            list-style-type: square;
        }
        .bai-lien-quan ul li a {
            font-size: 18px;
        }
        .row {
            margin-bottom: 7px;
        }
        .row div {
            line-height:26px;
            font-size:18px;
        }
    </style>
@endsection
@section('body')
{{-- @include('Frontend.widget_banner') --}}
<section class="news-wrapper padding-xs">
    <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <h3 style="padding-bottom:20px;"><i class="fa fa-book" aria-hidden="true"></i> {{ __('Chi tiết Thông tin Công bố Khoa học') }}</h3>
            <div class="card-box">
                @if($ds['nhan_de'])
                <div class="row">
                    <div class="col-md-2">{{ __('Nhan đề') }}:</div>
                    <div class="col-md-10">{{ $ds['nhan_de'] }}</div>
                </div>
                @endif
                @if($ds['ten_tac_gia'])
                <div class="row">
                    <div class="col-md-2">{{ __('Tên tác giả') }}:</div>
                    <div class="col-md-10">{{ $ds['ten_tac_gia'] }}</div>
                </div>
                @endif
                @if($ds['nguon_trich'])
                <div class="row">
                    <div class="col-md-2">{{ __('Nguồn trích') }}:</div>
                    <div class="col-md-10">{{ $ds['nguon_trich'] }}</div>
                </div>
                @endif
                @if($ds['nam_xuat_ban'])
                <div class="row">
                    <div class="col-md-2">{{ __('Năm xuất bản') }}:</div>
                    <div class="col-md-10">{{ $ds['nam_xuat_ban'] }}</div>
                </div>
                @endif
                @if($ds['so'])
                <div class="row">
                    <div class="col-md-2">{{ __('Số') }}:</div>
                    <div class="col-md-10">{{ $ds['so'] }}</div>
                </div>
                @endif
                @if($ds['trang'])
                <div class="row">
                    <div class="col-md-2">{{ __('Trang') }}:</div>
                    <div class="col-md-10">{{ $ds['trang'] }}</div>
                </div>
                @endif
                @if($ds['issn_isbn'])
                <div class="row">
                    <div class="col-md-2">{{ __('ISSN/ISBN') }}:</div>
                    <div class="col-md-10">{{ $ds['issn_isbn'] }}</div>
                </div>
                @endif
                @if($ds['tu_khoa'])
                <div class="row">
                    <div class="col-md-2">{{ __('Từ khóa') }}:</div>
                    <div class="col-md-10">{{ $ds['tu_khoa'] }}</div>
                </div>
                @endif
                @if($ds['tom_tat'])
                <div class="row">
                    <div class="col-md-2">{{ __('Tóm tắt') }}:</div>
                    <div class="col-md-10">{!! $ds['tom_tat'] !!}</div>
                </div>
                @endif
            </div>
            <br />
            <h3 style="padding-bottom:20px;"><i class="fa fa-book" aria-hidden="true"></i> {{ __('Xem thêm') }}</h3>
            <div class="card-box">
                <div class="row">
                    <div class="col-md-12 bai-lien-quan">
                        @if($danhsach)
                        <ul>
                        @foreach($danhsach as $lds)
                            <li>
                                <a href="{{ env('APP_URL').app()->getLocale() }}/cong-bo-khoa-hoc/{{ $lds['slug'] }}">
                                    {{ $lds['nhan_de'] }}
                                </a>
                            </li>
                        @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
          </div>
        </div>
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
