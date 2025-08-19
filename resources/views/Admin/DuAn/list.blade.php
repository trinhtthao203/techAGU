@extends('Admin.layout')
@section('title', __('Dự án'))
@section('css')
    <link href="{{ env('APP_URL') }}assets/backend/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('body')
<div class="row">
    <div class="col-12 card-box">
        <h3 class="m-t-0"><a href="{{ env('APP_URL').app()->getLocale() }}/admin/du-an/add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{ __('Thêm mới') }}</a> {{ __('Dự án') }}</h3>
        <hr />
        <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{ __('STT') }}</th>
                    <th>{{ __('Tên dự án') }}</th>
                    <th>{{ __('Cơ quan chủ trì') }}</th>
                    <th>{{ __('Đơn vị tài trợ') }}</th>
                    <th>{{ __('Cán bộ dự án') }}</th>
                    <th>{{ __('Thời gian thực hiện') }}</th>
                    <th width="50" class="text-center">#</th>
                    @foreach($arr_lang as $klang => $vlang)
                        @if($klang != app()->getLocale())
                            <th><img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}.jpg" alt="" class="flag-icon"></th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
            @if(isset($danhsach) && $danhsach)
                @foreach($danhsach as $k => $ds)
                    <tr>
                        <td class="text-center">{{ ($k+1) }}</td>
                        <td>
                            <a href="{{ env('APP_URL').app()->getLocale() }}/du-an/{{ $ds['slug'] }}" target="_blank">
                                {{ $ds['ten_du_an'] }}
                            </a>
                        </td>
                        <td>{{ $ds['co_quan_chu_tri'] }}</td>
                        <td>{{ $ds['don_vi_tai_tro'] }}</td>
                        <td>{{ $ds['can_bo_du_an'] }}</td>
                        <td>{{ $ds['thoi_gian_thuc_hien'] }}</td>
                        <td class="text-center">
                            <a href="{{ env('APP_URL').$ds['locale'] }}/admin/du-an/delete/{{$ds['_id']}}" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-danger"></i></a>
                            <a href="{{ env('APP_URL').$ds['locale'] }}/admin/du-an/edit/{{$ds['_id']}}"><i class="fas fa-pencil-alt"></i></a>
                        </td>
                        @foreach($arr_lang as $klang => $vlang)
                        @if($klang != app()->getLocale())
                        @php
                            $lang = $ds['locale'];
                            $id_path = App\Http\Controllers\ObjectController::ObjectId($ds['_id']);
                            $transpath = App\Models\TranslatePath::where("id_".$lang,"=",$id_path)->where('collection','=','du_an')->first();
                        @endphp
                            <td class="text-center text-middle">
                                @if($transpath && isset($transpath['id_'.$klang]))
                                    <a href="{{ env('APP_URL') }}{{ $klang }}/admin/du-an/edit/{{ $transpath["id_$klang"] }}?trans_id={{ $ds['_id'] }}&trans_lang={{ app()->getLocale() }}">
                                        <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}.jpg" alt="" class="flag-icon">
                                    </a>
                                @else
                                <a href="{{ env('APP_URL') }}{{ $klang }}/admin/du-an/add?trans_id={{ $ds['_id'] }}&trans_lang={{ app()->getLocale() }}">
                                    <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}_black.jpg" alt="" class="flag-icon">
                                </a>
                                @endif
                            </td>
                        @endif
                    @endforeach
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        {{-- $danhsach->withPath(env('APP_URL').'admin/du-an?' . $_SERVER['QUERY_STRING']) --}}
    </div>
</div>
@endsection
@section('js')
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
        });
    </script>
@endsection
