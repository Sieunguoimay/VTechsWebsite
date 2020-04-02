@extends('layouts.app')
@section('style')
<style>
#btn_booking{
    display:none !important;
}
</style>
@endsection
@section('content')
<div class="container py-5">
    <h3>Orders</h3>
    <div class="row justify-content-center">
        <div class="col-11">
            {!!$content!!}
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection
