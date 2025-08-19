@extends('Admin.layout')
@section('title', __('Thêm Nghiên cứu Khoa học'))
@section('css')
<link href="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
   
<link href="{{ env('APP_URL') }}assets/backend/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('body')
<div class="row">
  <div class="col-12">
        <div class="card-box">
            <h3 class="m-t-0"><a href="{{ env('APP_URL').app()->getLocale() }}/admin/nghien-cuu-khoa-hoc" class="btn btn-primary btn-sm"><i class="mdi mdi-reply-all"></i> {{ __('Trở về') }}</a> {{ __('Thêm mới Nghiên cứu Khoa học') }}</h3>
            <form action="{{ env('APP_URL').app()->getLocale() }}/admin/nghien-cuu-khoa-hoc/create" method="post" id="dinhkemform" enctype="multipart/form-data">
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
                        if(old('ten_nhiem_vu') != null) {
                            $ten_nhiem_vu = old('ten_nhiem_vu');
                            $chu_nhiem_nhiem_vu = old('chu_nhiem_nhiem_vu');
                            $thoi_gian_thuc_hien = old('thoi_gian_thuc_hien');
                        } else if(isset($ds['ten_nhiem_vu']) && $ds['ten_nhiem_vu']) {
                            $ten_nhiem_vu = $ds['ten_nhiem_vu'];
                            $chu_nhiem_nhiem_vu = $ds['chu_nhiem_nhiem_vu'];
                            $thoi_gian_thuc_hien = $ds['thoi_gian_thuc_hien'];
                        } else {
                            $ten_nhiem_vu= '';$chu_nhiem_nhiem_vu= '';$thoi_gian_thuc_hien= '';
                        }
                    @endphp   
                    <div class="row form-group">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Tên đề tài') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="ten_nhiem_vu" name="ten_nhiem_vu" class="form-control" placeholder="{{ __('Tên đề tài') }}" value="{{ $ten_nhiem_vu }}"  />
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Năm nghiệm thu') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="thoi_gian_thuc_hien" name="thoi_gian_thuc_hien" class="form-control" placeholder="{{ __('Năm nghiệm thu') }}" value="{{ $thoi_gian_thuc_hien }}" />
                        </div>
                    </div>
                    <div class="row form-group">   
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Chủ nhiệm đề tài') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="chu_nhiem_nhiem_vu" name="chu_nhiem_nhiem_vu" class="form-control" placeholder="{{ __('Chủ nhiệm đề tài') }}" value="{{ $chu_nhiem_nhiem_vu }}" />
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Cấp') }}</label>
                        <div class="col-md-4">
                            <select name="tags" id="tags" class="form-control select2" required>
                                <option value="">{{__('Chọn')}}</option>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag }}">{{ __($tag) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>            
                    <div class="progress m-b-20" id="progressbar">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="card-box" style="background-color:#eee;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="btn btn-info">
                                            <input type="file" name="dinhkem_files[]" class="dinhkem_files btn btn-primary" multiple accept="*" placeholder="Chọn tập tin đính kèm" style="display:none;" />
                                            <i class="mdi mdi mdi-attachment"></i> {{ __('Đính kèm') }} : (pdf, xlsx, docx, pptx, zip, ....)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="list_files">
                        @if(old('file_aliasname'))
                            @foreach(old('file_aliasname') as $key => $dk)
                                <div class="form-group row items draggable-element">
                                <input type="hidden" name="file_aliasname[]" value="{{ $dk }}" readonly/>
                                <input type="hidden" name="file_filename[]" value="{{ old('file_filename')[$key] }}" class="form-control"/>
                                <div class="col-12">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">@</span>
                                      </div>
                                      <input type="hidden" name="file_size[]" value="{{ old('file_size')[$key] }}" class="form-control">
                                      <input type="hidden" name="file_type[]" value="{{ old('file_type')[$key] }}" class="form-control">
                                      <input type="text" name="file_title[]" placeholder="{{ __('Chú thích tập tinh đính kèm') }}" value="{{ old('file_title')[$key] }}" class="form-control">
                                      <div class="input-group-append">
                                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/file/delete/{{ $dk }}" class="btn btn-info btn-circle delete_file" onclick="return false;" style="margin-left:2px;"><i class="mdi mdi-delete"></i></a>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                        @elseif(isset($ds['attachments']) && $ds['attachments'])
                                @foreach($ds['attachments'] as $dk)
                                    <div class="form-group row items draggable-element">
                                    <input type="hidden" name="file_aliasname[]" value="{{ $dk['aliasname'] }}" readonly/>
                                    <input type="hidden" name="file_filename[]" value="{{ $dk['filename'] }}" class="form-control"/>
                                    <div class="col-12">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                          </div>
                                          <input type="hidden" name="file_size[]" value="{{ $dk['size'] }}" class="form-control">
                                          <input type="hidden" name="file_type[]" value="{{ $dk['type'] }}" class="form-control">
                                          <input type="text" name="file_title[]" placeholder="{{ __('Chú thích tập tinh đính kèm') }}" value="{{ $dk['title'] }}" class="form-control">
                                          <div class="input-group-append">
                                            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/file/delete/{{ $dk['aliasname'] }}" class="btn btn-info btn-circle delete_file" onclick="return false;" style="margin-left:2px;"><i class="mdi mdi-delete"></i></a>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                @endforeach
                        @endif
                        </div>
                    </div>
               </div>
                <div class="form-actions">
                    <a href="{{ env('APP_URL').app()->getLocale() }}/admin/nghien-cuu-khoa-hoc" class="btn btn-light"><i class="fa fa-reply-all"></i> {{ __('Trở về') }}</a>
                    <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> {{ __('Cập nhật') }}</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.js" type="text/javascript"></script>
    <script src="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="{{ env('APP_URL') }}assets/backend/js/drag-arrange.min.js" type="text/javascript"></script>
    <script src="{{ env('APP_URL') }}assets/backend/libs/ckeditor/ckeditor.js"></script>
    <script src="{{ env('APP_URL') }}assets/backend/libs/switchery/switchery.min.js"></script>
    <script src="{{ env('APP_URL') }}assets/backend/js/script.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            delete_file();$(".select2").select2();
            var options = {
                filebrowserImageBrowseUrl: '{{ env('APP_URL') }}laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '{{ env('APP_URL') }}laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '{{ env('APP_URL') }}laravel-filemanager?type=Files',
                filebrowserUploadUrl: '{{ env('APP_URL') }}laravel-filemanager/upload?type=Files&_token='
            };

            upload_files("{{ env('APP_URL') }}{{ app()->getLocale() }}/file/uploads");
            upload_hinhanh("{{ env('APP_URL') }}{{ app()->getLocale() }}/image/uploads");
            $("#ten").change(function(){
                var title = $(this).val();
                $.get("{{ env('APP_URL') }}{{ app()->getLocale() }}/slug/" + title, function(slug){
                    $("#slug").val(slug);
                });
            });
            $("#progressbar").hide();
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
            CKEDITOR.replace('noi_dung', options);
        });
    </script>
@endsection
