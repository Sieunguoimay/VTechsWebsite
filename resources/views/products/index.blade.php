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
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12 pb-3 pt-4 border-top">
                <h1 style="line-height: 0.5em;">Tất cả sản phẩm</h1>
                <small>Các sản phẩm bán chạy nhất. Được cập nhập từng giờ.</small>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-0 col-xs-0 border-right pt-0">
                {!!$categories_list!!}
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 pt-0">
            @if(count($products)>0)
            <div class="container">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12 p-1">
                            <div class="card card-slider">
                                <a href="/products/{{$product->id}}" class="custom-card"style="text-decoration:none;">
                                    <img class="card-img-top img-fluid" 
                                        src="/storage/{{$product->cover_image}}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{strip_tags(str_limit($product->name,64))}}</h5>
                                        <p class="card-text" style="color:#fa6543; margin-bottom:1px" >{{$product->list_price}} vnd</p>
                                        <small class="font-italic text-muted">Đăng {{$product->created_at->diffForHumans()}}</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            {{$products->links("pagination::bootstrap-4")}} 
                        </div>
                    </div>
                </div>
            </div>
            @else
                <p>No products found</p>
            @endif
            </div>
            <div class="col-xl-1 col-lg-1 col-md-0 col-sm-0 col-xs-0">
            </div>
        </div>
    </div>
    
    <br><br><hr><br>
    <div class="container">
        <h3>Bài viết có thể bạn quan tâm</h3>
    </div>
    @include('inc.posts_slider')
    

@endsection
