<!--- Image Slider -->
@if(count($slides)>0)
<div id="slides" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
        {{-- <li data-target="#slides" data-slide-to="0" class="active"></li>
        <li data-target="#slides" data-slide-to="1"></li>
        <li data-target="#slides" data-slide-to="2"></li> --}}
        @foreach($slides as $slide)
            <li data-target="#slides" data-slide-to="{{$loop->index}}"
                @if ($loop->index==0)
                    class="active"
                @endif
                ></li>
        @endforeach
    </ul>
    <div class="carousel-inner">
        <div class="carousel-caption">
            <h1 class="display-2">VTechs</h1>
            <h3>Pin năng lượng mặt trời</h3>
            {{-- <button type="button" class="btn btn-outline-light btn-lg">Products</button> --}}
            <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href = '/products';">Get Started</button>
        </div>
        @foreach($slides as $slide)
            @if ($loop->index==0)
                <div class="carousel-item active">
                    <img src="storage/cover_images/{{$slide}}">
                </div>
            @else
                <div class="carousel-item">
                    <img src="storage/cover_images/{{$slide}}">
                </div>
            @endif
        @endforeach

{{-- 
        <div class="carousel-item active">
            <img src="storage/cover_images/slide1.jpg">
        </div>
        <div class="carousel-item">
            <img src="storage/cover_images/slide2.jpg">
        </div>
        <div class="carousel-item">
            <img src="storage/cover_images/slide3.jpg">
        </div> --}}
    </div>
</div>
@endif