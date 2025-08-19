@extends('Admin.layout')
@section('title', __('Nhân sự'))
@section('css')
    <link href="{{ env('APP_URL') }}assets/backend/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/magnific-popup.css"/>
@endsection
@section('body')
<div class="row">
    <div class="col-12 card-box">
        <h3 class="m-t-0"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/{{ $tags }}/add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{ __('Thêm mới') }}</a> {{ __('Nhân sự') }} </h3>
        <hr />
        @if($danhsach)
        <table class="table table-border table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>{{ __('STT') }}</th>
                    <th>{{ __('HÌNH') }}</th>
                    <th>{{ __('Họ tên') }}</th>
                    <th>{{ __('Chức vụ') }}</th>
                    <th>{{ __('Học vị') }}</th>
                    <th>{{ __('Chuyên ngành') }}</th>
                    <th>{{ __('Điện thoại') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Thứ tự') }}</th>
                    <th style="width:55px;">#</th>
                    @foreach($arr_lang as $klang => $vlang)
                        @if($klang != app()->getLocale())
                            <th><img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}.jpg" alt="" class="flag-icon"></th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
            @foreach($danhsach as $key => $ds)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td class="text-center">
                        @if(isset($ds['photos'][0]['aliasname']) && $ds['photos'][0]['aliasname'])
                        <a href="{{ env('APP_URL') }}storage/images/origin/{{ $ds['photos'][0]['aliasname'] }}" class="image-popup">
                            <img src="{{ env('APP_URL') }}storage/images/thumb_50/{{ $ds['photos'][0]['aliasname'] }}" title="{{ $ds['ho_ten'] }}" alt="{{ $ds['ho_ten'] }}" style="height:30px;">
                        </a>
                        @else
                            {{ __('NO PIC') }}
                        @endif
                    </td>
                    <td>{{ $ds['ho_ten'] }}</td>
                    <td>{{ __($ds['chuc_vu'] )}}</td>
                    <td>{{ __($ds['hoc_vi']) }}</td>
                    <td>{{ __($ds['chuyen_nganh']) }}</td>
                    <td>{{ $ds['dien_thoai'] }}</td>
                    <td>{{ $ds['email'] }}</td>
                    <td>{{ $ds['thu_tu'] }}</td>
                    <td class="text-center">
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/{{ $tags }}/delete/{{ $ds['_id'] }}" onclick="return confirm('Chắc chắc xóa?')"><i class="fas fa-trash text-danger"></i></a>&nbsp;
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/{{ $tags }}/edit/{{ $ds['_id'] }}"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                    @foreach($arr_lang as $klang => $vlang)
                        @if($klang != app()->getLocale())
                        @php
                            $lang = $ds['locale'];
                            $id_path = App\Http\Controllers\ObjectController::ObjectId($ds['_id']);
                            $transpath = App\Models\TranslatePath::where("id_".$lang,"=",$id_path)->where('collection','=','nhan_su')->first();
                        @endphp
                            <td class="text-center text-middle">
                                @if($transpath && isset($transpath['id_'.$klang]))
                                    <a href="{{ env('APP_URL') }}{{ $klang }}/admin/nhan-su/{{ $tags }}/edit/{{ $transpath["id_$klang"] }}?trans_id={{ $ds['_id'] }}&trans_lang={{ app()->getLocale() }}">
                                        <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}.jpg" alt="" class="flag-icon">
                                    </a>
                                @else
                                <a href="{{ env('APP_URL') }}{{ $klang }}/admin/nhan-su/{{ $tags }}/add?trans_id={{ $ds['_id'] }}&trans_lang={{ app()->getLocale() }}">
                                    <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}_black.jpg" alt="" class="flag-icon">
                                </a>
                                @endif
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr />
        @endif
        @if(Session::get('msg') != null && Session::get('msg'))
            <div class="alert alert-danger"><h3><i class="fas fa-save"></i> {{ Session::get('msg') }}</h3></div>
        @endif
        <hr />
        <div class="card-box">
            <h3 class="m-t-0"><i class="far fa-file-alt text-primary"></i> {{ __('Giới thiệu tổng quan') }}</h3>
            @if(Session::get('msg') != null && Session::get('msg'))
                <div class="alert alert-danger"><h3><i class="fas fa-save"></i> {{ Session::get('msg') }}</h3></div>
            @endif
            <hr />
            <form action="{{ env('APP_URL').app()->getLocale() }}/admin/nhan-su/tong-quan/{{$tags}}/update" method="post" id="dinhkemform" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row form-group">
                    <div class="col-md-12">
                        <textarea name="noi_dung" id="noi_dung" style="height:150px;" class="form-control" placeholder="Nội dung">{{ $noi_dung }}</textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ env('APP_URL').app()->getLocale() }}" class="btn btn-light"><i class="fa fa-reply-all"></i> {{ __('Trở về') }}</a>
                    <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> {{ __('Cập nhật') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ env('APP_URL') }}assets/backend/libs/ckeditor/ckeditor.js"></script>
    <script src="{{ env('APP_URL') }}assets/backend/libs/jquery-toast/jquery.toast.min.js"></script>
    <script type="text/javascript" src="{{ env('APP_URL') }}assets/backend/libs/isotope/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            @if(Session::get('msg') != null && Session::get('msg'))
            $.toast({
                heading:"Thông báo",
                text:"{{ Session::get('msg') }}",
                loaderBg:"#3b98b5",icon:"info", hideAfter:3e3,stack:1,position:"top-right"
            });
            @endif
            $('.image-popup').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'mfp-fade',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                }
            });     
            var options = {
                filebrowserImageBrowseUrl: '{{ env('APP_URL') }}laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '{{ env('APP_URL') }}laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '{{ env('APP_URL') }}laravel-filemanager?type=Files',
                filebrowserUploadUrl: '{{ env('APP_URL') }}laravel-filemanager/upload?type=Files&_token=',
                height: '400px'
            };
            CKEDITOR.replace('noi_dung', options);
        });
    </script>
@endsection
