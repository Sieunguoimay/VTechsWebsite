@extends('layouts.app')
@section('content')

{{-- 
    zoom image example
https://www.magictoolbox.com/magiczoomplus/examples/ 
--}}

<div class="container padding">
    <br><br>
    <h1>All Products</h1>
    @if(count($products)>0)
    <div class="container">
        <div class="row">
            @foreach($products as $product)
            <div class="col-sm-3">
                <div class="card">
                    <div class="view overlay zoom">
                        <img class="img-fluid img-hover-zoom" src="/storage/{{$product['images'][0]}}">
                        <div class="card-body">
                            <h3>{{$product['name']}}</h3>
                            <small class="font-italic text-muted">Uploaded on dd/mm/yyyy</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection


