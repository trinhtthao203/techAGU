@extends('Frontend.layout')
@section('title', __('Nghiên cứu khoa học'))
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
                    <h2 style="color: #058B3C;">{{ __('Nghiên cứu') }}</h2>
                </div>
            </div>
        </div>
      </div>
  </div>
  </div>
{{-- @include('Frontend.widget_banner') --}}
<section class="news-wrapper padding-xs">
    <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <h3 style="padding-bottom:20px;"><i class="fa fa-envira"></i> {{ __('Nghiên cứu khoa học') }}</h3>
            <div class="card-box">                         
                <div class="row">
             
                    <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead > 
                            <tr">
                                <th style="font-weight: bold; text-align: center;" width="5%">{{ __('STT') }}</th>
                                <th style="font-weight: bold; text-align: center;" width="50">{{ __('Tên đề tài') }}</th>
                                <th style="font-weight: bold; text-align: center;" width="30%">{{ __('Tên CNĐT') }}</th>
                                <th style="font-weight: bold; text-align: center;" width="15%"> {{ __('Năm nghiệm thu') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($danhsach as $k =>$ds)
                            <tr>     
                                <td>{{ $loop->index + $danhsach->firstItem() }}</td>   
                                <th>
                                    @if($ds['attachments'])
                                        <a href="{{ env('APP_URL').app()->getLocale() }}/nghien-cuu-khoa-hoc/tai-ve/{{ $ds['_id'] }}/0">
                                            {{ $ds['ten_nhiem_vu']}}
                                        </a>
                                    @else
                                        {{ $ds['ten_nhiem_vu']}}
                                    @endif
                                </th> 
                                <th>{{ $ds['chu_nhiem_nhiem_vu']}}</th>
                                <th style=" text-align: center;" >{{ $ds['thoi_gian_thuc_hien']}}</th>
                            </tr>@endforeach
                        </tbody>
                    </table>
               
                </div>
            </div>   
          </div>
        </div>
        <br />
        {{ $danhsach->withPath(env('APP_URL').app()->getLocale().'/nghien-cuu-khoa-hoc') }}
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
