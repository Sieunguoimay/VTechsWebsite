<!--- Cards -->
<div class="container">
    <div class="row">
        @if(count($posts)>0)
            @foreach ($posts as $post)
                @if($loop->index>2)
                    @break
                @endif
                @if($loop->index%3==0)
                <div class="col-md-4 col-sm-12">
                @else
                <div class="col-md-4 col-sm-6 col-xs-12">
                @endif
                <div class="card card-slider">
                    {{-- data-aos="flip-right" data-aos-duration="800" --}}
                    <a href="/posts/{{$post->id}}" class="custom-card">
                        <img class="card-img-top img-fluid" alt="Image" src="/storage/{{$post->cover_image}}">
                        <div class="card-body">
                            <h4 class="card-title" >{{$post->title}}</h4>
                            <small class="card-text">Đăng {{$post->created_at->diffForHumans()}}</small>
                            {{-- <p class="card-text">{!!$post->body!!} </p> --}}
                            {{-- <a href="/posts/{{$post->id}}" class="btn btn-outline-secondary mt-auto">Xem</a> --}}
                        </div>
                    </a>
                </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

{{-- 
<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="storage/cover_images/card_img.jpeg">
        <div class="card-body">
            <h4 class="card-title">Tam pin nang luong mat troi</h4>
            <p class="card-text">Posted 2 days ago</p>
            <a href="#" class="btn btn-outline-secondary">See Post</a>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="storage/cover_images/card_img.jpeg">
        <div class="card-body">
            <h4 class="card-title">Tam pin nang luong mat troi</h4>
            <p class="card-text">Posted 2 days ago</p>
            <a href="#" class="btn btn-outline-secondary">See Post</a>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="storage/cover_images/card_img.jpeg">
        <div class="card-body">
            <h4 class="card-title">Tam pin nang luong mat troi</h4>
            <p class="card-text">Posted 2 days ago</p>
            <a href="#" class="btn btn-outline-secondary">See Post</a>
        </div>
    </div>
</div> --}}
