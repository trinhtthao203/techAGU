@extends('Admin.layout')
@section('title', __('Đối tác'))
@section('css')
    <link href="{{ env('APP_URL') }}assets/backend/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/magnific-popup.css"/>
@endsection
@section('body')
<div class="row">
    <div class="col-12 card-box">
        <h3 class="m-t-0"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/doi-tac/add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{ __('Thêm mới') }}</a> {{ __('Đối tác') }}</h3>
        <hr />
        @if($danhsach)
        <table class="table table-border table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>{{ __('STT') }}</th>
                    <th>{{ __('Hình') }}</th>
                    <th>{{ __('Tên') }}</th>
                    <th style="width:55px;">#</th>
                    @foreach($arr_lang as $klang => $vlang)
                        @if($klang != app()->getLocale())
                            <th><img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}.jpg" alt="" class="flag-icon"></th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
            @foreach($danhsach as $key => $ds)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td class="text-center">
                        @if(isset($ds['photos'][0]['aliasname']) && $ds['photos'][0]['aliasname'])
                        <a href="{{ env('APP_URL') }}storage/images/origin/{{ $ds['photos'][0]['aliasname'] }}" class="image-popup">
                            <img src="{{ env('APP_URL') }}storage/images/thumb_50/{{ $ds['photos'][0]['aliasname'] }}" title="{{ $ds['ho_ten'] }}" alt="{{ $ds['ho_ten'] }}" style="height:30px;">
                        </a>
                        @else
                            {{ __('NO PIC') }}
                        @endif
                    </td>
                    <td>
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/@if(app()->getLocale() == 'vi'){{ 'doi-tac' }}@else{{ ('news-and-events') }}@endif/{{ $ds['slug'] }}" target="_blank"><strong>{{ $ds['ten'] }}</strong></a>
                        <span class="badge badge-info"><small>{{ App\Http\Controllers\ObjectController::getDate($ds['date_post'],"d/m/Y H:i") }}</small></span>
                    </td>
                    <td class="text-center">
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/doi-tac/delete/{{ $ds['_id'] }}" onclick="return confirm('Chắc chắc xóa?')"><i class="fas fa-trash text-danger"></i></a>&nbsp;
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/doi-tac/edit/{{ $ds['_id'] }}"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                    @foreach($arr_lang as $klang => $vlang)
                        @if($klang != app()->getLocale())
                        @php
                            $lang = $ds['locale'];
                            $id_path = App\Http\Controllers\ObjectController::ObjectId($ds['_id']);
                            $transpath = App\Models\TranslatePath::where("id_".$lang,"=",$id_path)->where('collection','=','doi_tac')->first();
                        @endphp
                            <td class="text-center text-middle">
                                @if($transpath && isset($transpath['id_'.$klang]))
                                    <a href="{{ env('APP_URL') }}{{ $klang }}/admin/doi-tac/edit/{{ $transpath["id_$klang"] }}?trans_id={{ $ds['_id'] }}&trans_lang={{ app()->getLocale() }}">
                                        <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}.jpg" alt="" class="flag-icon">
                                    </a>
                                @else
                                <a href="{{ env('APP_URL') }}{{ $klang }}/admin/doi-tac/add?trans_id={{ $ds['_id'] }}&trans_lang={{ app()->getLocale() }}">
                                    <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}_black.jpg" alt="" class="flag-icon">
                                </a>
                                @endif
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $danhsach->withPath(env('APP_URL') . app()->getLocale() . '/admin/doi-tac') }}
        @endif
    </div>
</div>
@endsection
@section('js')
    <script src="{{ env('APP_URL') }}assets/backend/libs/jquery-toast/jquery.toast.min.js"></script>
    <script type="text/javascript" src="{{ env('APP_URL') }}assets/backend/libs/isotope/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            @if(Session::get('msg') != null && Session::get('msg'))
            $.toast({
                heading:"Thông báo",
                text:"{{ Session::get('msg') }}",
                loaderBg:"#3b98b5",icon:"info", hideAfter:3e3,stack:1,position:"top-right"
            });
            @endif
            $('.image-popup').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'mfp-fade',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                }
            });
        });
    </script>
@endsection
