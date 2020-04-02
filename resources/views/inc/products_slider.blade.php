<div class="container">
    <div class="row">
        @if(count($products)>0)
            @foreach ($products as $product)
                @if($loop->index>3)
                    @break
                @endif
                <div class="col-md-3 col-sm-6 col-xs-6 col-xs-offset-3">
                    <div class="card card-slider">
                        {{-- data-aos="zoom-out" data-aos-duration="800" --}}
                    <a href="/products/{{$product->id}}" class="custom-card" style="text-decoration: none;">
                        <img class="card-img-top rounded-pill" alt="Products" src="/storage/{{$product->cover_image}}">
                        <div class="card-body">
                            <h5 class="card-title text-center giveMeEllipsis-2" >{{$product->name}}</h5>
                            <p class="card-text" style="color:#fa6543; margin-bottom:1px" >{{number_format($product->list_price, 0, '.', ',')}} vnd</p>
                            <small class="card-text">Đăng {{$product->created_at->diffForHumans()}}</small>
                            {{-- <p class="card-text">{!!$product->body!!} </p> --}}
                            {{-- <a href="/products/{{$product->id}}" class="btn btn-outline-secondary mt-auto">See product</a> --}}
                        </div>
                    </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
