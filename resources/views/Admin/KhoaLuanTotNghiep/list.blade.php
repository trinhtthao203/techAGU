@extends('Admin.layout')
@section('title', __('Khóa luận tốt nghiệp'))
@section('css')
<link href="{{ env('APP_URL') }}assets/backend/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('body')
<div class="row">
    <div class="col-12 card-box">
        <h3 class="m-t-0"><a href="{{ env('APP_URL').app()->getLocale() }}/admin/khoa-luan-tot-nghiep/add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{ __('Thêm mới') }}</a> {{ __('Khóa luận tốt nghiệp') }}</h3>
        <hr />
        <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{ __('STT') }}</th>
                    <th>{{ __('Loại') }}</th>
                    <th>{{ __('Tiêu đề') }}</th>                    
                    <th class="text-center">#</th>
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
                        <td class="text-center">{{ $ds['tags'] }}</td>
                        <td class="text-center">{{ $ds['tieu_de'] }}</td>
                        <td class="text-center">
                            <a href="{{ env('APP_URL').$ds['locale'] }}/admin/khoa-luan-tot-nghiep/delete/{{$ds['_id']}}" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-danger"></i></a>
                            <a href="{{ env('APP_URL').$ds['locale'] }}/admin/khoa-luan-tot-nghiep/edit/{{$ds['_id']}}"><i class="fas fa-pencil-alt"></i></a>
                        </td>
                        @foreach($arr_lang as $klang => $vlang)
                        @if($klang != app()->getLocale())
                        @php
                            $lang = $ds['locale'];
                            $id_path = App\Http\Controllers\ObjectController::ObjectId($ds['_id']);
                            $transpath = App\Models\TranslatePath::where("id_".$lang,"=",$id_path)->where('collection','=','nghien_cuu_khoa_hoc')->first();
                        @endphp
                            <td class="text-center text-middle">
                                @if($transpath && isset($transpath['id_'.$klang]))
                                    <a href="{{ env('APP_URL') }}{{ $klang }}/admin/khoa-luan-tot-nghiep/edit/{{ $transpath["id_$klang"] }}?trans_id={{ $ds['_id'] }}&trans_lang={{ app()->getLocale() }}">
                                        <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}.jpg" alt="" class="flag-icon">
                                    </a>
                                @else
                                <a href="{{ env('APP_URL') }}{{ $klang }}/admin/khoa-luan-tot-nghiep/add?trans_id={{ $ds['_id'] }}&trans_lang={{ app()->getLocale() }}">
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
        {{-- $danhsach->withPath(env('APP_URL').'admin/nghien-cuu-khoa-hoc?' . $_SERVER['QUERY_STRING']) --}}
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
