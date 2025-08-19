@extends('Frontend.layout')
@section('title', __('Hội nghị Hội thảo'))
@section('body')
<section class="news-wrapper padding-xs">
  <div class="container">
    <div class="row">
      <div class="col-8 col-md-8">
        <h3 style="padding-bottom:20px;"><i class="fa fa-cog" aria-hidden="true"></i> {{ __('Hội nghị Hội thảo') }}</h3>
      </div>
    </div>
    @if($danhsach)
        <ul class="row news-listing" style="position: relative; height: 5035.97px;">
          @foreach($danhsach as $ds)
            <li class="col-xs-6 col-sm-4 grid-item" style="position: absolute; left: 0%; top: 0px;">
              <div class="inner">
                @if($ds['photos'] && isset($ds['photos'][0]['aliasname']) && $ds['photos'][0]['aliasname'])
                    <img src="{{ env('APP_URL') }}storage/images/thumb_360x200/{{ $ds['photos'][0]['aliasname'] }}" class="img-responsive" alt="" style="width:360px;height:200px;">
                @else
                    <img src="{{ env('APP_URL') }}assets/frontend/images/default_thumb.jpg" class="img-responsive" alt="">
                @endif
                  <div class="cnt-block">
                    <ul class="post-detail">
                      <li><span class="icon-date-icon ico"></span> <span class="bold">{{ App\Http\Controllers\ObjectController::getDate($ds['updated_at'], "d/m/Y H:i") }}</li>
                    </ul>
                    <h2 style="height:130px;overflow:hidden;"><a href="{{ env('APP_URL').app()->getLocale() }}/hoi-nghi-hoi-thao/{{ $ds['slug'] }}" title="{{ $ds['ten'] }}">{{ Str::limit($ds['ten'],100) }}</a></h2>
                    <p  style="height:100px;overflow:hidden;">{{ $ds['mo_ta'] }}</p>
                    <br />
                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/hoi-nghi-hoi-thao/{{ $ds['slug'] }}" class="read-more"><span class="icon-play-icon"></span>{{ __('Xem thêm') }}</a>
                </div>
            </div>
          </li>
          @endforeach
        </ul>
        {{ $danhsach->withPath(env('APP_URL').app()->getLocale() . '/hoi-nghi-hoi-thao') }}
    @endif
  </div>
</section>
@endsection
@section('js')
    <script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/masonry/js/masonry.min.js"></script></script>
@endsection
