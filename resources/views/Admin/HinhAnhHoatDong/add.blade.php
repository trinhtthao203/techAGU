@extends('Admin.layout')
@section('title', __('Thêm mới Hình Ảnh hoạt động'))
@section('css')
    <link href="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/magnific-popup.css"/>
    <link href="{{ env('APP_URL') }}assets/backend/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('body')
<div class="row">
  <div class="col-12">
        <div class="card-box">
            <h3 class="m-t-0"><a href="{{ env('APP_URl') }}{{ app()->getLocale() }}/admin/hinh-anh-hoat-dong" class="btn btn-primary"><i class="mdi mdi-reply-all"></i></a> {{__('Thêm mới')}} {{__('Hình ảnh hoạt động')}}</h3>
            <form action="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/hinh-anh-hoat-dong/create" method="post" id="dinhkemform" enctype="multipart/form-data">
                {{ csrf_field() }}
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2 text-right p-t-10">{{ __('Tiêu đề') }}</label>
                                <div class="col-md-10">
                                    <input type="text" id="title" name="title" class="form-control" placeholder="{{__('Tiêu đề')}}" value="{{ old('title') }}" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Mô tả') }}</label>
                        <div class="col-md-10">
                            <input type="text" name="url" value="{{ old('url') }}" placeholder="URL" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Thứ tự') }}</label>
                        <div class="col-md-2">
                            <input type="number" name="thutu" id="thutu" value="{{ old('thutu') != null ? old('thutu') : 0 }}" placeholder="Thứ tự" class="form-control">
                        </div>
                        <div class="col-md-2 switchery-demo">
                            <b>{{ __('Tình trạng') }}: </b>
                            <input type="checkbox" name="status" id="status" class="js-switch" data-plugin="switchery" data-color="#009efb" value="1"/>
                        </div>
                    </div>
                    <div class="progress m-b-20" id="progressbar">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2 text-right p-t-10">{{ __('Hình ảnh') }}</label>
                                <div class="col-md-2">
                                    <label class="btn btn-danger">
                                        <input type="file" name="hinhanh_files[]" class="hinhanh_files btn btn-primary" multiple accept="image/png, image/jpeg, image/jpg, image/gif" placeholder="Chọn hình ảnh" style="display:none;" />
                                    <i class="fa fa-images"></i> {{ __('Hình ảnh') }}
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
                                    <a href="{{ env('APP_URL')}}image/delete/{{ old('hinhanh_aliasname')[$k] }}" onclick="return false;" class="btn btn-danger btn-sm delete_file" style="position:absolute;top:40px;right:30px;">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <input type="text" name="hinhanh_title[]" class="form-control" value="{{ old('hinhanh_title')[$k] }}" />
                                </div>
                            @endforeach
                        @endif
                    </div>
               </div>
               <div class="form-actions">
                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/hinh-anh-hoat-dong" class="btn btn-light"><i class="fa fa-reply-all"></i> {{ __('Trở về') }}</a>
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
    <script src="{{ env('APP_URL') }}assets/backend/libs/switchery/switchery.min.js"></script>
    <script src="{{ env('APP_URL') }}assets/backend/js/script.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            upload_files("{{ env('APP_URL') }}{{ app()->getLocale() }}/file/uploads");
            upload_hinhanh("{{ env('APP_URL') }}{{ app()->getLocale() }}/image/uploads");
            delete_file();$(".select2").select2();
            $("#progressbar").hide();
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
        });
    </script>
@endsection
