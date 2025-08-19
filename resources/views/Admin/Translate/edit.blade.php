@extends('Admin.layout')
@section('title', __('Chỉnh sửa Translate'))
@section('body')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h3 class="m-t-0"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate" class="btn btn-primary"><i class="fa fa-reply-all"></i></a> {{ __('Chỉnh sửa Translate List') }}</h3>
            <form action="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate/update" method="post" id="dinhkemform" enctype="multipart/form-data">
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
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('KEY') }}</label>
                        <div class="col-md-10">
                            <input type="text" id="key" name="key" class="form-control" placeholder="{{ __('KEY') }}" value="{{ old('key') != null ? old('key') : $key }}" required />
                            <input type="hidden" id="old_key" name="old_key" class="form-control" placeholder="{{ __('KEY') }}" value="{{ $key }}" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('VALUE') }}</label>
                        <div class="col-md-10">
                            <input type="text" id="value" name="value" class="form-control" placeholder="{{ __('VALUE') }}" value="{{ old('value') != null ? old('value') : $value }}" required />
                        </div>
                    </div>
                </div>
                 <div class="form-actions">
                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate" class="btn btn-light"><i class="fa fa-reply-all"></i> {{ __('Trở về') }}</a>
                    <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> {{ __('Cập nhật') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
