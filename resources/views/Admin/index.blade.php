@extends('Admin.layout')
@section('title', __("Home"))
@section('body')
<div class="row">
    <div class="col-12">
        <div class="card-box text-center">
            <img src="{{ env('APP_URL') }}assets/backend/images/cover.png" alt="" align="center" style="width:100%; max-width: 700px;">
        </div>
    </div>
</div>
@endsection
