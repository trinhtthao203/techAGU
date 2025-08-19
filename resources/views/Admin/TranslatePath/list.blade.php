@extends('Admin.layout')
@section('title', __('Translate Path'))
@section('body')
<div class="card-box">
    <div class="row">
        <div class="col-12">
            <h3 class="m-t-0"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate-path/add" class="btn btn-info btn-sm"><i class="fas fa-code-branch"></i> {{ __('Thêm mới') }}</a> {{ __('Translate Path') }} </h3>
             <hr />
        <form method="GET" action="{{ env('APP_URL') . app()->getLocale() }}/admin/translate-path">
            <div class="row form-group">
                <div class="col-12 col-md-6">
                    <input type="text" name="slug" id="slug" value="{{ $slug }}" placeholder="Tìm Tên" class="form-control">
                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" name="submit" value="Search" class="btn btn-primary"><i class="fa fa-search"></i> {{ __('Tìm') }}</button>
                </div>
            </div>
        </form>
            @if($danhsach)
            <table class="table table-border table-bordered table-striped table-hovered table-sm">
                <thead>
                    <tr>
                        <th>{{ __('STT') }}</th>
                        <th>{{ __('VI') }}</th>
                        <th>{{ __('EN') }}</th>
                        <th>{{ __('Collection') }}</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($danhsach as $key => $ds)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $ds['slug_vi'] }}</td>
                        <td>{{ $ds['slug_en'] }}</td>
                        <td>{{ $ds['collection'] }}</td>
                        <td class="text-center" width="100">
                            @if($ds['id_vi'] || $ds['id_en'])
                                @php
                                    if($ds['collection'] == 'dm_thong_tin') $path = 'danh-muc-thong-tin';
                                    else if($ds['collection'] == 'thong_tin') $path = 'thong-tin';
                                    else $path = '';
                                @endphp
                                @if($ds['id_vi'])
                                    <a href="{{ env('APP_URL') }}vi/admin/{{ $path }}/edit/{{ $ds['id_vi'] }}"><img src="{{ env('APP_URL') }}assets/backend/images/flags/vi.jpg" style="width:20px;border:1px solid #ccc;"></a>
                                @elseif($ds['id_en'])
                                    <a href="{{ env('APP_URL') }}vi/admin/{{ $path }}/add?trans_id={{ $ds['id_en'] }}&trans_lang=en"><img src="{{ env('APP_URL') }}assets/backend/images/flags/vi_black.jpg" style="width:20px;border:1px solid #ccc;"></a>
                                @else
                                    <a href="{{ env('APP_URL') }}vi/admin/{{ $path }}/add"><img src="{{ env('APP_URL') }}assets/backend/images/flags/vi_black.jpg" style="width:20px;border:1px solid #ccc;"></a>
                                @endif

                                @if($ds['id_en'])
                                    <a href="{{ env('APP_URL') }}en/admin/{{ $path }}/edit/{{ $ds['id_en'] }}"><img src="{{ env('APP_URL') }}assets/backend/images/flags/en.jpg" style="width:20px;border:1px solid #ccc;"></a>
                                @elseif($ds['id_vi'])
                                    <a href="{{ env('APP_URL') }}en/admin/{{ $path }}/add?trans_id={{ $ds['id_vi'] }}&trans_lang=vi"><img src="{{ env('APP_URL') }}assets/backend/images/flags/en_black.jpg" style="width:20px;border:1px solid #ccc;"></a>
                                @else
                                    <a href="{{ env('APP_URL') }}en/admin/{{ $path }}/add"><img src="{{ env('APP_URL') }}assets/backend/images/flags/en_black.jpg" style="width:20px;border:1px solid #ccc;"></a>
                                @endif
                            @else
                                {{-- <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate-path/delete/{{ $ds['_id'] }}" class="" onclick="return confirm('Chắc chắn xóa?');"><i class="fa fa-trash text-danger"></i> </a> --}}
                                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate-path/edit/{{ $ds['_id'] }}" class=""><i class="fa fa-pencil-alt"></i></a>
                            @endif
                            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate-path/delete/{{ $ds['_id'] }}" class="" onclick="return confirm('Chắc chắn xóa?');"><i class="fa fa-trash text-danger"></i> </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @php
                $q = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';

            @endphp
            {{ $danhsach->withPath(env('APP_URL') . app()->getLocale() . '/admin/translate-path?'.$q) }}
            @endif
        </div>
    </div>
</div>
@endsection
