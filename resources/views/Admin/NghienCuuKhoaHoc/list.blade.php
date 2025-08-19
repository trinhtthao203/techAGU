@extends('Admin.layout')
@section('title', __('Nghiên Cứu Khoa Học'))
@section('css')
    <link href="{{ env('APP_URL') }}assets/backend/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('body')
<div class="row">
    <div class="col-12 card-box">
        <h3 class="m-t-0"><a href="{{ env('APP_URL').app()->getLocale() }}/admin/nghien-cuu-khoa-hoc/add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{ __('Thêm mới') }}</a> {{ __('Nghiên cứu Khoa học') }}</h3>
        <hr />
        <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{ __('STT') }}</th>
                    <th>{{ __('Cấp') }}</th>
                    <th>{{ __('Tên đề tài') }}</th>
                    <th>{{ __('Chủ nhiệm đề tài') }}</th>
                    <th>{{ __('Năm nghiệm thu') }}</th>
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
                        <td class="text-center"> {{__($ds['tags'])}}</td>
                        <td>{{ $ds['ten_nhiem_vu'] }}</td>
                        <td>{{ $ds['chu_nhiem_nhiem_vu'] }}</td>
                        <td>{{ $ds['thoi_gian_thuc_hien'] }}</td>
                        <td class="text-center">
                            <a href="{{ env('APP_URL').$ds['locale'] }}/admin/nghien-cuu-khoa-hoc/delete/{{$ds['_id']}}" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-danger"></i></a>
                            <a href="{{ env('APP_URL').$ds['locale'] }}/admin/nghien-cuu-khoa-hoc/edit/{{$ds['_id']}}"><i class="fas fa-pencil-alt"></i></a>
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
                                    <a href="{{ env('APP_URL') }}{{ $klang }}/admin/nghien-cuu-khoa-hoc/edit/{{ $transpath["id_$klang"] }}?trans_id={{ $ds['_id'] }}&trans_lang={{ app()->getLocale() }}">
                                        <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}.jpg" alt="" class="flag-icon">
                                    </a>
                                @else
                                <a href="{{ env('APP_URL') }}{{ $klang }}/admin/nghien-cuu-khoa-hoc/add?trans_id={{ $ds['_id'] }}&trans_lang={{ app()->getLocale() }}">
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
        });
    </script>
@endsection
