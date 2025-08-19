@extends('Frontend.layout')
@section('title', $ds['ten'])
@section('description', $ds['ten'])
@if(isset($ds['photos'][0]['aliasname']) && $ds['photos'][0]['aliasname'])
  @section('image', env("APP_URL") . 'storage/images/origin/'. $ds['photos'][0]['aliasname'])
@endif
@section('body')
<!-- Start About -->
<section class="about">
    <div class="container">
        <div class="row" style="padding-bottom:20px;">
          <div class="col-12">
              <h3>{{ $ds['ten'] }}</h3>
          </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12" style="text-align:justify;">
              {!! $ds['noi_dung'] !!}
            </div>
        </div>
        @if($ds['photos'])
        <br />
        <div class="row campus-tour">
          <div class="col-md-12">
            <h4><i class="fa fa-picture-o" aria-hidden="true"></i> {{ __('HÌNH ẢNH') }}</h4><br />
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
        @if($ds['attachments'])
        <br />
        <div class="row">
          <div class="col-md-12">
            <h4><i class="fa fa-file-code-o" aria-hidden="true"></i> {{ __('ĐÍNH KÈM') }}</h4> <br />
            <table class="table table-border table-striped">
              <thead>
                <tr>
                  <th>{{ __('STT') }}</th>
                  <th>{{ __('Nội dung') }}</th>
                  <th>{{ __('Tải về') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($ds['attachments'] as $key => $dk)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>
                    @if(strtolower($dk['type']) == 'pdf') <a href="{{ env('APP_URL').app()->getLocale() }}/dich-vu/xem-truc-tuyen/{{ $ds['_id'] }}/{{ $key }}" data-toggle="modal" data-target="#xemdinhkem" class="view_online"> @endif
                      {{ $dk['title'] }}
                    @if(strtolower($dk['type']) == 'pdf') </a> @endif
                  </td>
                  <td>
                    <a href="{{ env('APP_URL').app()->getLocale() }}/dich-vu/tai-ve/{{ $ds['_id'] }}/{{ $key }}">
                      <img src="{{ env('APP_URL') }}assets/frontend/images/download.svg" height="20" />
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        @endif
        @if($danhsach && $danhsach->count() > 0)
        <br />
        <div class="row">
          <div class="col-md-12">
            <h4><i class="fa fa-link" aria-hidden="true"></i> {{ __('DỊCH VỤ LIÊN QUAN') }}</h4>
            <ul class="list-quy-che">
              @foreach($danhsach as $r)
                <li class="rtejustify"><a href="{{ env('APP_URL').app()->getLocale() }}/dich-vu/{{ $r['slug'] }}">{{ $r['ten'] }}</a></li>
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
