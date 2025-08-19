@extends('Frontend.layout')
@section('title', __('Hình ảnh hoạt động'))
@section('body')
<section class="news-wrapper padding-xs how-study padding-lg" style="background-color: white;">
  <div class="container">
    <div class="row">
      <div class="col-8 col-md-8">
        <h3 style="padding-bottom:20px;text-transform:uppercase;color: #058B3C;"><i class="fa fa-newspaper-o"></i> {{ __('Hình ảnh hoạt động') }}</h3>
      </div>
    </div>     
      @if($danhsach)  
        <ul class="row">
          @foreach($danhsach as $b)
            @if($b['photos'])
             @foreach($b['photos'] as $p)
              <li class="col-sm-3" style="margin-top: 10px;">
                <a class="galleryItem" href="{{ env('APP_URL') }}storage/images/origin/{{ $p['aliasname'] }}"> 
                  <figure><img style="object-fit: cover;height: 250px;width:300px; margin-left:13px;margin-top: 13px;" src="{{ env('APP_URL') }}storage/images/origin/{{ $p['aliasname'] }}" alt="{{ $b['title'] }}" title="{{ $b['title'] }}"" class="img-responsive" alt=""></figure>
                </a> 
             </li>
             @endforeach
            @endif
          @endforeach
          @if($danhsach_hinh_anh_hoat_dong2)
          @foreach($danhsach_hinh_anh_hoat_dong2 as $b)
            @if($b['photos'])
             @foreach($b['photos'] as $p)
              <li class="col-sm-3" style="margin-top: 10px;">
                <a class="galleryItem" href="{{ env('APP_URL') }}storage/images/origin/{{ $p['aliasname'] }}"> 
                  <figure><img style="object-fit: cover;height: 250px;width:300px; margin-left:13px;margin-top: 13px;" src="{{ env('APP_URL') }}storage/images/origin/{{ $p['aliasname'] }}" alt="{{ $b['title'] }}" title="{{ $b['title'] }}"" class="img-responsive" alt=""></figure>
                </a> 
             </li>
             @endforeach
            @endif
          @endforeach
          @endif
        </ul>
      @endif
  </div>
</section>
<div style="display: block;text-align:center">{{$danhsach->links()}}</div>
@endsection
@section('js')
    <script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/masonry/js/masonry.min.js"></script></script>
@endsection
