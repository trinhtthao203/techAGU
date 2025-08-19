@extends('Admin.layout')
@section('title', __('Liên hệ'))
@section('css')
    <link href="{{ env('APP_URL') }}assets/backend/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('body')
<div class="card-box">
    <h3 class="m-t-0"><i class="far fa-file-alt text-primary"></i> {{ __('Liên hệ') }}</h3>
    @if(Session::get('msg') != null && Session::get('msg'))
        <div class="alert alert-danger"><h3><i class="fas fa-save"></i> {{ Session::get('msg') }}</h3></div>
    @endif
    <hr />
    <form action="{{ env('APP_URL').app()->getLocale() }}/admin/lien-he/update" method="post" id="dinhkemform" enctype="multipart/form-data">
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
@endsection
@section('js')
    <script src="{{ env('APP_URL') }}assets/backend/libs/ckeditor/ckeditor.js"></script>
    <script src="{{ env('APP_URL') }}assets/backend/libs/jquery-toast/jquery.toast.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            @if(Session::get('msg') != null && Session::get('msg'))
            $.toast({
                heading:"Thông báo",
                text:"{{ Session::get('msg') }}",
                loaderBg:"#3b98b5",icon:"info", hideAfter:3e3,stack:1,position:"top-right"
            });
            @endif
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
