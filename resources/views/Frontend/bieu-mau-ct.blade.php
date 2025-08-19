@extends('Frontend.layout')
@section('title', $ds['ten'])
@section('description', $ds['mo_ta'])
@if(isset($ds['photos'][0]['aliasname']) && $ds['photos'][0]['aliasname'])
  @section('image', env("APP_URL") . 'storage/images/origin/'. $ds['photos'][0]['aliasname'])
@endif
@section('css')
<style type="text/css" media="screen">
  .about .noi-dung h3 {
    text-transform: none;
    line-height: 40px;
    margin-top: 20px;
  }
  .about .noi-dung ul {
    margin-left: 10px;
    margin-bottom: 20px;
  }
  .tags {
    background: #27316b;
    color:#fff;
    padding: 5px 20px;
  }
</style>
@endsection

@section('body')
<!-- Start About -->
<section class="about">
    <div class="container noi-dung">
      <p>{{ __('Trang chủ') }} <i class="fa fa-angle-double-right" aria-hidden="true"></i> <strong>{{ __('Biểu mẫu') }}</strong></p>
      <h3 style="text-transform:uppercase;">{{ $ds['ten'] }}</h3>
        <div class="row" style="padding-bottom:20px;">
          <div class="col-12 text-right">
            @if(isset($ds['views']))<i class="fa fa-eye"></i> {{ $ds['views'] }} @endif
          </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12" style="text-align:justify;">
              <p>{{ $ds['mo_ta'] }}</p>
            </div>
        </div>
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
                    <a href="#" data-toggle="modal" data-target="#xemdinhkem" class="view_online">
                      {{ $dk['title'] }}
                    </a>
                  </td>
                  <td>
                    <a href="{{ env('APP_URL').app()->getLocale() }}/bieu-mau/tai-ve/{{ $ds['_id'] }}/{{ $key }}">
                      <img src="{{ env('APP_URL') }}assets/frontend/images/download.svg" height="20" />
                    </a>
                  </td
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
            <h4><i class="fa fa-link" aria-hidden="true"></i> {{ __('Xem thêm') }}</h4>
            <ul class="list-quy-che">
              @foreach($danhsach as $r)
                <li class="rtejustify"><a href="{{ env('APP_URL').app()->getLocale() }}/bieu-mau/{{ $r['slug'] }}">{{ $r['ten'] }}</a></li>
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
