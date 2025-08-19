@extends('Admin.layout')
@section('title', __('Lịch sử'))
@section('css')
  <link href="{{ env('APP_URL') }}assets/backend/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
  @endsection
@section('body')
<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">
      <h3 class="m-t-0"></a> {{ __('Lịch sử cập nhật') }}</h3>
      <table id="responsive-datatable" class="table table-bordered table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th data-sort-initial="true" data-toggle="true">{{ __('STT') }}</th>
            <th width="300px">{{ __('Họ tên') }}</th>
            <th>{{ __('Hành động') }}</th>
            <th>{{ __('Thời gian') }}</th>
          </tr>
        </thead>
        <tbody>
          @if($danhsach)
              @foreach($danhsach as $key => $logs)
              <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $logs['fullname']}}</td>
                  <td>{{ $logs['action']}}</td>
                  <td>{{ $logs['updated_at']}}</td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section('js')
  <script src="{{ env('APP_URL') }}assets/backend/libs/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ env('APP_URL') }}assets/backend/libs/datatables/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#responsive-datatable').DataTable();
    });
  </script>
@endsection
