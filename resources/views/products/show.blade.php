

@extends('layouts.app')
@section('style')
<style>

img.active{
    border: 1px solid #d9d9d9; /* Green */
    box-shadow: 0px 0px 5px #d9d9d9;
}

</style>
<meta property="og:site_name" content="VTechs">
<meta property="og:url" content="{{Request::url()}}">  
<meta property="og:type" content="website"> 
<meta property="og:type" content="article">
<meta property="og:title" content="{{$product->name}}">
<meta property="og:description" content="{{strip_tags(str_limit($product->description,64))}}">
<meta property="og:image" content="http://vtechs.vn/storage/{{$product->cover_image}}">
<meta property="fb:app_id" content="799659427166307">
@endsection


@section('content')
<br><br>


<div class="container-fluid">
    
    @if(!Auth::guest())
        @if(Auth::user()->id===$product->user_id)

        <div class="row">
            <div class="col-sm-10  m-0 p-0"></div>
            <div class="col-sm-2  m-0 p-0">
                <div class="container">
                    <div class="row">
                        <a href="/products/{{$product->id}}/edit" class="btn btn-default">Edit</a>
                        {!!Form::open(['action'=>['ProductsController@destroy',$product->id],'method'=>'POST','class'=>'pull-right'])!!}
                            {{ method_field('DELETE') }}
                            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>

        @endif
    @endif
    <div class="row product ml-md-5 mr-md-5 top-buffer">
        <div class="col-md-1 col-sm-1 col-xs-12 p-0" id="product_photos_list">
            @if(count($product_photos)>0)
            @foreach($product_photos as $photo)
                @if($loop->index==0)
                    <img class="img-fluid p-1 active" style="max-height:80px; max-width:100px !important" src="/storage/{{$photo->path}}">
                @else
                    <img class="img-fluid p-1" style="max-height:80px !important; max-width:100px" src="/storage/{{$photo->path}}">
                @endif
            @endforeach
            @endif
        </div>
        <div class="col-md-5 col-sm-5 col-xs-12 p-1">
            @if(!empty($product))
                <img class="img-fluid" id="myImg" src="/storage/{{$product->cover_image}}">
            @endif
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 p-1">
            <div class="card p-2">

                <div class="card-head p-1">
                    <h3>{{$product->name}}</h3>

                    @include('inc.share_button')
                    <small>Đăng {{$product->created_at->diffForHumans()}}</small>

                </div>
                <hr>
                <div class="card-body p-1">
                    <p style="line-height: 0.5em;"><label>Giá bán:</label> {{number_format($product->list_price, 0, '.', ',')}} vnd</p>
                    <p style="line-height: 0.5em;"><label>Số lượng còn:</label> {{$product->quantity}}</p>
                    <p style="line-height: 0.5em;"><label>Loại sản phẩm:</label> 
                        <a href="{{route('products.index',['category_id'=>$product->category->id])}}">
                            {{$product->category->name}}
                        </a>
                    </p>
                    <h5>Mô tả sản phẩm:</h5>
                    <div class="card p-2 m-1">
                        {!!$product->description!!}
                    </div>
                </div>
                <div class="card-body p-1">
                    <h6 class="text-info">Quan tâm đến sản phẩm này?</h6>
                    <div class="row">
                        <div class="col-auto">
                            <a href="/contact" class="btn btn-success d-inline">Liên hệ</a>
                        </div>
                        <div class="col-auto ml-auto pb-2 mr-1 align-self-end">
                            <p class="mb-0 text-muted">
                                <img src="/storage/logos_and_icons/eye.png" style="height:20px;margin-bottom:4px;">
                                {{count($product->views)}} lượt xem</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>

<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal Content (The Image) -->
    <img class="modal-content" id="img01">
    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
    <!-- The Close Button -->
    {{-- <span class="close">&times;</span> --}}
</div>
<div class="container">
    <hr>
    <h4>Thông tin thêm</h4>
    <p>Liên hệ với chúng tôi ngay hôm nay để nhận được nhiều ưu đãi.</p>
    <br><br>
</div>

<div class="container">
    <hr>
    <h4>Các sản phẩm khác có thể bạn quan tâm</h4>
</div>
@include('inc.products_slider')
<br><br><br>
@endsection


@section('script')
<script>
    // console.log("ID babe","{{$product}}");
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
        console.log("clicked");
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    modal.onclick = function() {
        modal.style.display = "none";
    }
    var product_photos_list = document.getElementById("product_photos_list");
    $('#product_photos_list').on('click','img',function(e){
        img.src = e.target.src;

        var current = product_photos_list.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");

        e.target.className+=" active";
    });
    
    SendNewViewToServer('product',{{$product->id}});
</script>

@endsection