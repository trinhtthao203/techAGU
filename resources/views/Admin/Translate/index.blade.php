@extends('Admin.layout')
@section('title', 'Translate board')
@section('css')
<link href="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('body')
<div class="row">
    <div class="col-12 card-box">
        <div class="row">
            <div class="col-12 col-md-8">
                <h3 class="m-t-0"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate/add" class="btn btn-info"><i class="fas fa-language"></i> {{ __('Thêm mới') }}</a> {{ __('Translate') }} - {{ $arr_lang[app()->getLocale()] }}</h3>
            </div>
            <div class="col-12 col-md-4 text-right">
                <h3 class="m-t-0">
                @foreach($arr_lang as $lang_key => $lang_text)
                    @if($lang_key != app()->getLocale())
                        <a href="{{ env('APP_URL') }}{{ $lang_key }}/admin/translate">
                            <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $lang_key }}.jpg" alt="user-image" class="mr-1" height="18" style="border:1px solid #ccc;"> <span class="align-middle">{{ $arr_lang[$lang_key] }} </span>
                        </a>
                    @endif
                @endforeach
            </h3>
            </div>
        </div>
        <hr />
        <form action="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate" method="GET" id="articleForm">
            <div class="row form-group">
                <div class="col-md-6">
                    <input type="text" name="keyword" id="keyword" value="{{ $keyword }}" placeholder="{{ __('Keyword') }}" class="form-control">
                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" name="submit" value="OK" class="btn btn-primary"><i class="fa fa-search"></i> {{ __('Tìm kiếm') }}</button>
                </div>
            </div>
        </form>
        @if($data)
        <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{ __('KEY') }}</th>
                    <th>{{ __('VALUE') }}</th>
                    <th class="text-center">{{ __('Hiệu chỉnh') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $value)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $value }}</td>
                    <td class="text-center" width="100">
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate/delete/{{ $key }}" class="" onclick="return confirm('Chắc chắn xóa?');"><i class="fa fa-trash text-danger"></i> </a>
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate/edit/{{ $key }}" class=""><i class="fa fa-pencil-alt"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert alert-danger">
            <h3><i class="fa fa-search"></i> Kết quả không tìm thấy </h3>
        </div>
        @endif
    </div>
</div>
@endsection
