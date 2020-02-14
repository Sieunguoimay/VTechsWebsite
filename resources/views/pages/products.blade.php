@extends('layouts.app')
@section('content')
    <h1>{{$title}}</h1>
    @if(count($products)>0)
        <ul>
        @foreach($products as $product)
            <li class="list-group-item">{{$product}}</li>
        @endforeach
        </ul>
    @endif
@endsection
