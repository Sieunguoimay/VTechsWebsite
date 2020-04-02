@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <h3>Profile</h3>
                <div class="card p-2">
                    <p >User name: {{auth()->user()->name}}</p>
                    <p>Registered: {{auth()->user()->created_at}}</p>
                    <p>Email: {{auth()->user()->email}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
