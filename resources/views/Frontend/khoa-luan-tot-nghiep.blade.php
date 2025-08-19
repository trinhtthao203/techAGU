@extends('Frontend.layout')
@section('title', __('Khóa luận tốt nghiệp'))
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
    </style>
@endsection
@section('body')
<div class="col-12">
  <div class="inner-banner contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="content" style="width:100%;">     
                    <h2 style="color: #058B3C;">{{__('Khoá luận')}}</h2>
                </div>
            </div>
        </div>
      </div>
  </div>
</div>
<section class="about">
  <div class="container noi-dung"> 
    @foreach($danhsach as $ds)
      @if($ds['attachments'])
      <br />
      <div class="row">
        <div class="col-md-12">
          <h4><i class="fa fa-file-code-o" aria-hidden="true"></i> {{$ds['tieu_de']}}</h4> <br />

              @foreach($ds['attachments'] as $key => $dk)
                  <a href="{{ env('APP_URL').app()->getLocale() }}/khoa-luan-tot-nghiep/xem-truc-tuyen/{{ $ds['_id'] }}/{{ $key }}" data-toggle="modal" data-target="#xemdinhkem" class="view_online">
                    {{ $dk['title'] }}
                  </a>     
                  <a href="{{ env('APP_URL').app()->getLocale() }}/khoa-luan-tot-nghiep/tai-ve/{{ $ds['_id'] }}/{{ $key }}">
                    <img src="{{ env('APP_URL') }}assets/frontend/images/download.svg" height="20" />
                  </a>
                  <embed src=" {{env('APP_URL')}}storage/files/{{$ds['attachments'][$key]['aliasname']}}" style="width:100%;min-height:80vh;height:100% !important;" />
              @endforeach
        </div>
      </div>
      @endif 
      <div style="width: 100%; height: 20px;color:black"> 
        <br/>
      </div>  
      @endforeach
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
