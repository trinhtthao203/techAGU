@extends('Admin.layout')
@section('title', __('Thêm Dự án'))
@section('css')
<link href="{{ env('APP_URL') }}assets/backend/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('body')
<div class="row">
  <div class="col-12">
        <div class="card-box">
            <h3 class="m-t-0"><a href="{{ env('APP_URL').app()->getLocale() }}/admin/du-an" class="btn btn-primary btn-sm"><i class="mdi mdi-reply-all"></i> {{ __('Trở về') }}</a> {{ __('Thêm mới Dự án') }}</h3>
            <form action="{{ env('APP_URL').app()->getLocale() }}/admin/du-an/create" method="post" id="dinhkemform" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="trans_id" id="trans_id" value="{{ $trans_id }}" placeholder="">
                <input type="hidden" name="trans_lang" id="trans_lang" value="{{ $trans_lang }}" placeholder="">
                <div class="form-body">
                    <hr />
                    @if($errors->any())
                        <div class="alert alert-success">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @php
                        if(old('ten_du_an') != null) {
                            $ten_du_an = old('ten_du_an');
                            $co_quan_chu_tri = old('co_quan_chu_tri');
                            $don_vi_tai_tro = old('don_vi_tai_tro');
                            $can_bo_du_an = old('can_bo_du_an');
                            $thoi_gian_thuc_hien = old('thoi_gian_thuc_hien');
                            $noi_dung_hoat_dong = old('noi_dung_hoat_dong');
                            $co_quan_chu_quan = old('co_quan_chu_quan');
                            $kinh_phi_tai_tro = old('kinh_phi_tai_tro');
                        } else if(isset($ds['ten_du_an']) && $ds['ten_du_an']) {
                            $ten_du_an = $ds['ten_du_an'];
                            $co_quan_chu_tri = $ds['co_quan_chu_tri'];
                            $don_vi_tai_tro = $ds['don_vi_tai_tro'];
                            $can_bo_du_an = $ds['can_bo_du_an'];
                            $thoi_gian_thuc_hien = $ds['thoi_gian_thuc_hien'];
                            $noi_dung_hoat_dong = $ds['noi_dung_hoat_dong'];
                            $co_quan_chu_quan = $ds['co_quan_chu_quan'];
                            $kinh_phi_tai_tro = $ds['kinh_phi_tai_tro'];
                        } else {
                            $ten_du_an = '';$co_quan_chu_tri = '';$don_vi_tai_tro = '';$can_bo_du_an = '';$thoi_gian_thuc_hien = '';$noi_dung_hoat_dong = '';$co_quan_chu_quan = '';$kinh_phi_tai_tro = '';
                        }
                    @endphp
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Tên dự án') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="ten_du_an" name="ten_du_an" class="form-control" placeholder="{{ __('Tên dự án') }}" value="{{ $ten_du_an }}" required />
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Cơ quan chủ trì') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="co_quan_chu_tri" name="co_quan_chu_tri" class="form-control" placeholder="{{ __('Cơ quan Chủ trì') }}" value="{{ $co_quan_chu_tri }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Cơ quan chủ quản') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="co_quan_chu_quan" name="co_quan_chu_quan" class="form-control" placeholder="{{ __('Cơ quan chủ quản') }}" value="{{ $co_quan_chu_quan }}"  />
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Cán bộ dự án') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="can_bo_du_an" name="can_bo_du_an" class="form-control" placeholder="{{ __('Cán bộ dự án') }}" value="{{ $can_bo_du_an }}" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Đơn vị tài trợ') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="don_vi_tai_tro" name="don_vi_tai_tro" class="form-control" placeholder="{{ __('Đơn vị tài trợ') }}" value="{{ $don_vi_tai_tro }}" />
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Kinh phí tài trợ') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="kinh_phi_tai_tro" name="kinh_phi_tai_tro" class="form-control" placeholder="{{ __('Kinh phí tài trợ') }}" value="{{ $kinh_phi_tai_tro }}" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Thời gian thực hiện') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="thoi_gian_thuc_hien" name="thoi_gian_thuc_hien" class="form-control" placeholder="{{ __('Thời gian thực hiện') }}" value="{{ $thoi_gian_thuc_hien }}" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Nội dung hoạt động') }}</label>
                        <div class="col-md-10">
                            <textarea name="noi_dung_hoat_dong" id="noi_dung_hoat_dong" style="height:80px;" class="form-control" placeholder="{{ __('Nội dung hoạt động') }}">{{ $noi_dung_hoat_dong }}</textarea>
                        </div>
                    </div>
               </div>
                <div class="form-actions">
                    <a href="{{ env('APP_URL').app()->getLocale() }}/admin/du-an" class="btn btn-light"><i class="fa fa-reply-all"></i> {{ __('Trở về') }}</a>
                    <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> {{ __('Cập nhật') }}</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ env('APP_URL') }}assets/backend/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{ env('APP_URL') }}assets/backend/libs/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            jQuery("#thoi_gian_bat_dau").datepicker({ format:"dd/mm/yyyy", autoclose: true});
            jQuery("#thoi_gian_ket_thuc").datepicker({ format:"dd/mm/yyyy", autoclose: true });
            var options = {
                filebrowserImageBrowseUrl: '{{ env('APP_URL') }}laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '{{ env('APP_URL') }}laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '{{ env('APP_URL') }}laravel-filemanager?type=Files',
                filebrowserUploadUrl: '{{ env('APP_URL') }}laravel-filemanager/upload?type=Files&_token='
            };
            CKEDITOR.replace('noi_dung_hoat_dong', options);
        });
    </script>
@endsection
