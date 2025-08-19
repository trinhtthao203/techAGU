@extends('Admin.layout')
@section('title', __('Thêm mới, Translate Path'))
@section('body')
    <div class="card-box">
        <div class="row">
            <div class="col-12">
                <h3 class="m-t-0"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate-path" class="btn btn-primary btn-sm"><i class="fa fa-reply-all"></i> {{ __('Trở về') }}</a> {{ __('Thêm mới Translate Path') }}</h3>
                <form action="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate-path/create" method="post" id="TranslatePathForm">
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
                        <div class="form-group row">
                            <label class="control-label col-md-2 text-right p-t-10">{{ __('VI') }}</label>
                            <div class="col-md-10">
                                <input type="text" id="slug_vi" name="slug_vi" class="form-control" placeholder="{{ __('Path Việt Nam') }}" value="{{ old('slug_vi') }}" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 text-right p-t-10">{{ __('EN') }}</label>
                            <div class="col-md-10">
                                <input type="text" id="slug_en" name="slug_en" class="form-control" placeholder="{{ __('Path English') }}" value="{{ old('slug_en') }}" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate-path" class="btn btn-light"><i class="fa fa-reply-all"></i> {{ __('Trở về') }}</a>
                        <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> {{ __('Cập nhật') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#slug_vi").change(function(){
                var title = $(this).val();
                $.get("{{ env('APP_URL') }}{{ app()->getLocale() }}/slug/" + title, function(slug){
                    $("#slug_vi").val(slug);
                });
            });
            $("#slug_en").change(function(){
                var title = $(this).val();
                $.get("{{ env('APP_URL') }}{{ app()->getLocale() }}/slug/" + title, function(slug){
                    $("#slug_en").val(slug);
                });
            });
        });
    </script>
@endsection
