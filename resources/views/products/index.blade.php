@extends('layouts.app')
@section('style')
<style>
.card-img-top {
    width: 100%;
    height: 15vw;
    object-fit: cover;
}
</style>
@endsection
@section('content')
    {{-- <div class="container">
        @foreach ($products as $product)
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img class="img-fluid" style="width:100%;" src="/storage/cover_images/{{$product->cover_image}}">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <h3><a href="/products/{{$product->id}}">{{$product->name}}</a></h3>
                        <small>Uploaded {{$product->created_at->diffForHumans()}}</small>
                    </div>
                </div>
        @endforeach
    </div> --}}

    <div class="container padding">
        <br><br>
        <br><br>
        <h1>All Products</h1>
        @if(count($products)>0)
        <div class="container">
            <div class="row">
                @foreach($products as $product)
                <div class="col-sm-3">
                    <div class="card">
                        <a href="/products/{{$product->id}}" class="custom-card">
                            <img class="card-img-top img-fluid" 
                                src="/storage/cover_images/{{$product->cover_image}}">
                            <div class="card-body">
                                <h3 class="card-title">{{$product->name}}</h3>
                                <small class="font-italic text-muted">Uploaded {{$product->created_at->diffForHumans()}}</small>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        {{$products->links()}} 
        @else
            <p>No products found</p>
        @endif
    </div>
    


@endsection
