

@extends('layouts.app')
@section('style')
<style>

img.active{
    border: 1px solid #d9d9d9; /* Green */
    box-shadow: 0px 0px 5px #d9d9d9;
}

</style>
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
        <div class="col-md-1 p-0" id="product_photos_list">
            @if(count($product_photos)>0)
            @foreach($product_photos as $photo)
                @if($loop->index==0)
                    <img class="img-fluid p-1 active" src="/storage/cover_images/{{$photo->path}}">
                @else
                    <img class="img-fluid p-1" src="/storage/cover_images/{{$photo->path}}">
                @endif
            @endforeach
            @endif
        </div>
        <div class="col-md-5 p-1">
            @if(!empty($product))

                <img class="img-fluid" id="myImg" src="/storage/cover_images/{{$product->cover_image}}">

            @endif
        </div>
        <div class="col-md-6 p-1">
            <div class="card p-2">
                <div class="text-right">
                    @include('inc.share_button')
                </div>
                <div class="card-head">
                    <h3>{{$product->name}}</h3>
                    <small>Uploaded {{$product->created_at->diffForHumans()}}</small>
                </div>
                <hr>
                <div class="card-body p-1">
                    <p>Price: {{$product->list_price}} vnd</p>
                    <p>In Stock: {{$product->quantity}}</p>
                    <h5>Desciption:</h5>
                    <div class="card p-2 m-1">
                        {!!$product->description!!}
                    </div>
                </div>
                <div class="card-body p-1">
                    <h6 class="text-info">Interested in this product?</h6>
                   <a href="/contact" class="btn btn-success">Contact Us</a>
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
    <h4>Contact us today to get a huge discount.</h4>
    <p>Should you have a concern or wish to report a complaint, call us today. We stand ready to help you in the best possible manner.</p>
    <br><br>
</div>

<div class="container">
    <hr>
    <h4>More items to explore</h4>
</div>
@include('inc.products_slider')
<br><br><br>
@endsection


@section('script')
<script>
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
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools --> 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e4ceb7df483e26a"></script>
@endsection