@extends('Admin.layout')
@section('title', __('Thêm mới Category'))
@section('css')
    <link href="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/magnific-popup.css"/>
    <link href="{{ env('APP_URL') }}assets/backend/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h3 class="m-t-0"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/category" class="btn btn-primary btn-sm"><i class="mdi mdi-reply-all"></i> {{ __('Trở về') }}</a> {{ __('Thêm mới Category') }}</h3>
            <form action="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/category/create" method="post" id="dinhkemform" enctype="multipart/form-data">
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
                        if(old('ten') != null){
                            $ten = old('ten'); 
                            $noi_dung = old('noi_dung');
                            $slug = old('slug');
                            $thu_tu = old('thu_tu'); 
                            $mo_ta = old('mo_ta');
                            $date_post = old('date_post'); 
                            $tin_moi = old('tin_moi');
                            $id_cat = old('id_cat');
                        } else if(isset($ds['ten']) && $ds['ten']){
                            $ten = $ds['ten']; 
                            $noi_dung = $ds['noi_dung'];
                            $slug = $ds['slug'];
                            $thu_tu = $ds['thu_tu']; 
                            $mo_ta = $ds['mo_ta'];
                            $date_post = $ds['date_post'];
                            $tin_moi = $ds['tin_moi'];
                            $id_cat = $ds['id_cat'];
                        } else {
                            $ten = '';
                            $noi_dung = '';
                            $slug='';
                            $thu_tu=0;
                            $mo_ta = ''; 
                            $date_post = App\Http\Controllers\ObjectController::setDate();
                            $tin_moi=0;
                            $id_cat= array();
                        }
                    @endphp
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Tên') }}</label>
                        <div class="col-md-10">
                            <input type="text" id="ten" name="ten" class="form-control" placeholder="{{ __('Tên') }}" value="{{ $ten }}" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Slug') }}</label>
                        <div class="col-md-10">
                            <input type="text" id="slug" name="slug" class="form-control" placeholder="{{ __('slug') }}" value="{{ $slug }}" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Mô tả') }}</label>
                        <div class="col-12 col-md-10">
                            <textarea name="mo_ta" id="mo_ta" class="form-control" required placeholder="{{ __('Mô tả nội dung') }}" style="height:100px;">{{ $mo_ta }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Nội dung') }}</label>
                        <div class="col-md-10">
                            <textarea name="noi_dung" id="noi_dung" class="form-control" required>{{ $noi_dung }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Ngày tạo') }}</label>
                        <div class="col-md-2">
                            <input type="text" id="date_post" name="date_post" class="form-control" placeholder="{{ __('Ngày tạo') }}" value="{{ $date_post }}" required />
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Thứ tự') }}</label>
                        <div class="col-md-1">
                            <input type="text" id="thu_tu" name="thu_tu" class="form-control" placeholder="{{ __('Thứ tự') }}" value="{{ $thu_tu }}" required />
                        </div>
                        <div class="col-md-2 switchery-demo">
                            <b>{{ __('Tin mới') }}: </b>
                            <input type="checkbox" name="tin_moi" id="tin_moi" class="js-switch" data-plugin="switchery" data-color="#009efb" value="1" @if($tin_moi) checked @endif/>
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Thuộc phân mục') }}</label>
                        <div class="col-12 col-md-10">
                            <select name="id_cat[]" id="id_cat" multiple class="form-control select2" required data-placeholder="{{__('Chọn phân loại')}}">
                                <option value="">{{ __('Chọn phân loại') }}</option>
                                @foreach($cats as $cat)
                                    <option value="{{ $cat }}" @if(in_array($cat, $id_cat)) selected @endif>{{ __($cat) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-box bg-light">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="btn btn-danger">
                                            <input type="file" name="hinhanh_files[]" class="hinhanh_files btn btn-primary" multiple accept="image/png, image/jpeg, image/jpg, image/gif" placeholder="Chọn hình ảnh" style="display:none;" />
                                            <i class="fa fa-images"></i> {{ __('Hình ảnh') }} : (jpg, png, bmp)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="list_hinhanh">
                            @if(old('hinhanh_aliasname'))
                                @foreach(old('hinhanh_aliasname') as $k => $h)
                                    <div class="col-sm-6 col-md-4 items draggable-element text-center">
                                        <input type="hidden" name="hinhanh_aliasname[]" value="{{ old('hinhanh_aliasname')[$k] }}" readonly/>
                                        <input type="hidden" name="hinhanh_filename[]" class="form-control" value="{{ old('hinhanh_filename')[$k] }}" />
                                        <a href="{{  env('APP_URL') }}storage/images/origin/{{ old('hinhanh_aliasname')[$k] }}" class="image-popup">
                                        <div class="portfolio-masonry-box">
                                          <div class="portfolio-masonry-img">
                                            <img src="{{ env('APP_URL') }}storage/images/thumb_360x200/{{ old('hinhanh_aliasname')[$k] }}" class="thumb-img img-fluid" alt="work-thumbnail">
                                          </div>
                                          <div class="portfolio-masonry-detail">
                                            <p>{{ old('hinhanh_filename')[$k] }}</p>
                                          </div>
                                        </div>
                                        </a>
                                        <a href="{{ env('APP_URL')}}{{ app()->getLocale() }}/image/delete/{{ old('hinhanh_aliasname')[$k] }}" onclick="return false;" class="btn btn-danger btn-sm delete_file" style="position:absolute;top:40px;right:30px;">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <input type="text" name="hinhanh_title[]" class="form-control" value="{{ old('hinhanh_title')[$k] }}" />
                                    </div>
                                @endforeach
                            @elseif(isset($ds['photos']) && $ds['photos'])
                                @foreach($ds['photos'] as $photo)
                                    <div class="col-sm-6 col-md-4 items draggable-element text-center">
                                        <input type="hidden" name="hinhanh_aliasname[]" value="{{ $photo['aliasname'] }}" readonly/>
                                        <input type="hidden" name="hinhanh_filename[]" class="form-control" value="{{ $photo['filename'] }}" />
                                        <a href="{{  env('APP_URL') }}storage/images/origin/{{ $photo['aliasname'] }}" class="image-popup">
                                        <div class="portfolio-masonry-box">
                                          <div class="portfolio-masonry-img">
                                            <img src="{{ env('APP_URL') }}storage/images/thumb_360x200/{{ $photo['aliasname'] }}" class="thumb-img img-fluid" alt="work-thumbnail">
                                          </div>
                                          <div class="portfolio-masonry-detail">
                                            <p>{{ $photo['filename'] }}</p>
                                          </div>
                                        </div>
                                        </a>
                                        <a href="{{ env('APP_URL')}}{{ app()->getLocale() }}/image/delete/{{ $photo['aliasname'] }}" onclick="return false;" class="btn btn-danger btn-sm delete_file" style="position:absolute;top:40px;right:30px;">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <input type="text" name="hinhanh_title[]" class="form-control" value="{{ $photo['title'] }}" />
                                    </div>
                                @endforeach
                            @endif
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
                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/category" class="btn btn-light"><i class="fa fa-reply-all"></i> {{ __('Trở về') }}</a>
                    <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> {{ __('Cập nhật') }}</button>
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
