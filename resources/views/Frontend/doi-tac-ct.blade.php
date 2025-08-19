@extends('Frontend.layout')
@section('title', $ds['ten'])
@section('description', $ds['mo_ta'])
@if(isset($ds['photos'][0]['aliasname']) && $ds['photos'][0]['aliasname'])
  @section('image', env("APP_URL") . 'storage/images/origin/'. $ds['photos'][0]['aliasname'])
@endif
@section('body')
@include('Frontend.widget_banner')
<!-- Start About -->
<section class="about">
    <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <h3><i class="fa fa-handshake-o"></i> {{ $ds['ten'] }}</h3>
          </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-sm-12 col-md-12" style="text-align:justify;">
              <p>{{ $ds['mo_ta'] }}</p>
              {!! $ds['noi_dung'] !!}
            </div>
        </div>
        @if($ds['photos'] && count($ds['photos']) > 1)
        <br />
        <div class="row campus-tour">
          <div class="col-md-12">
            <h3><i class="fa fa-picture-o" aria-hidden="true"></i> {{ __('HÌNH ẢNH') }}</h3>
            <hr />
            <ul class="gallery clearfix">
              @foreach($ds['photos'] as $h)
              <li>
                  <div class="overlay">
                      <a class="galleryItem" href="{{ env('APP_URL') }}storage/images/origin/{{ $h['aliasname'] }}" title="{{ $h['title'] }}"> <span class="icon-enlarge-icon"></span></a>
                  </div>
                  <figure><img src="{{ env('APP_URL') }}storage/images/thumb_360x200/{{ $h['aliasname'] }}" class="img-gallery" alt=""></figure>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
        @endif
        @if($danhsach && $danhsach->count() > 0)
        <br /><br />
        <div class="row">
          <div class="col-md-12">
            <h4>{{ __('Thông tin liên quan') }}</h4>
            <ul class="list-quy-che">
              @foreach($danhsach as $r)
                <li class="rtejustify"><a href="{{ env('APP_URL').app()->getLocale() }}/doi-tac/{{ $r['slug'] }}">{{ $r['ten'] }}</a></li>
              @endforeach
            </ul>
          </div>
        </div>
        @endif
    </div>
</section>

<div id="xemdinhkem" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="width:95%;">
        <div class="modal-content" style="height:800px !important;">
            <div class="modal-header">
                <h4 class="modal-title" id="myExtraLargeModalLabel">{{ __('Thông tin chi tiết') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="chitiet" class="modal-body" style="height:700px; overflow:hidden;">
                {{ __('Xin chào') }}
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
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
