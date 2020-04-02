@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        <h3>{{$data->title}}</h3>
        <table class="table table-hover">
            <thead>
                <th>Browser</th>
                <th>Key</th>
                <th>User Id</th>
                <th>Views ({{$data->total_views}})</th>
            </thead>
            <tbody>
                @foreach($fingerprints as $fingerprint)
                <tr>
                    <td>{{$fingerprint->browser}}</td>
                    <td>{{$fingerprint->hash}}</td>
                    <td>{{$fingerprint->user_name}}</td>
                    <td>{{$fingerprint->views_count}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
