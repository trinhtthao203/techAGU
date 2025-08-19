@extends('Frontend.layout')
@section('title', __('Văn bản'))
@section('css')
    <style type="text/css" media="screen">
        .noi-dung h3 {
            text-transform: none;
        }
        .card-box {
            background: #fff;
            margin-bottom: 20x;
            padding: 20px;
            border-radius: 10px;
        }
        .bai-lien-quan ul {
            list-style-type: square;
        }
        .bai-lien-quan ul li a{
            font-size: 18px;
        }

    </style>
@endsection
@section('body')
{{-- @include('Frontend.widget_banner') --}}
<section class="news-wrapper padding-xs">
    <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <h1 style="color: #058B3C;" class="text-center">{{ __('Văn bản') }}</h1>
            <h3 style="padding:20px;color: #058B3C;"><i class="fa fa-file-text-o" aria-hidden="true"></i> Văn bản Quản lý - Điều hành</h3>
            <div class="card-box">
                    <div class="row">
                        <div class="col-md-12 bai-lien-quan">
                            <ul>                           
                                <li>   
                                    <a href="https://www.agu.edu.vn/vi/tin-tuc-su-kien/van-ban-quan-ly-dieu-hanh">
                                    Văn bản Quản lý - Điều hành
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @foreach($cats as $cat)
                @php
                    $locale = app()->getLocale();
                    $danhsach = App\Models\VanBan::where('id_cat', $cat)->get();
                @endphp
            @if($danhsach && $danhsach->count() > 0)
                <h3 style="padding:20px;color: #058B3C;"><i class="fa fa-file-text-o" aria-hidden="true"></i> {{ $cat }}</h3>
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12 bai-lien-quan">
                            <ul>                            
                            @foreach($danhsach as $ds)                            
                            @if($ds['attachments'])
                            <!-- foreach($ds['attachments'] as $key => $dk) -->
                                <li>   
                                    <a href="{{ env('APP_URL').app()->getLocale() }}/van-ban-ct/{{$ds['slug']}}">
                                        {{ $ds['ten'] }}
                                    </a>
                                </li>
                            <!-- endforeach -->    
                            @else                    
                            <li>   
                                <a style="color: #058B3C;" href="{{$ds['mo_ta']}}">
                                    {{ $ds['ten'] }}
                                </a>
                            </li>
                            @endif                            
                            @endforeach
                            
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
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
