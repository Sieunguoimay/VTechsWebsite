<!--- Image Slider -->
@if(count($slides)>0)

<div id="slides" class="carousel slide" data-ride="carousel">
    {{-- <ul class="carousel-indicators"> --}}
        {{-- <li data-target="#slides" data-slide-to="0" class="active"></li>
        <li data-target="#slides" data-slide-to="1"></li>
        <li data-target="#slides" data-slide-to="2"></li> --}}
        {{-- @foreach($slides as $slide)
            <li data-target="#slides" data-slide-to="{{$loop->index}}"
                @if ($loop->index==0)
                    class="active"
                @endif
                ></li>
        @endforeach
    </ul> --}}
    <div class="carousel-inner" role="listbox" style=" width:100%; height: 500px !important;">
        <div class="carousel-caption">
            <h1 class="display-2">VTechs</h1>
            <h3>Pin năng lượng mặt trời</h3>
            {{-- <button type="button" class="btn btn-outline-light btn-lg">Products</button> --}}
            <a type="button" class="btn btn-primary btn-lg" href="#home_products_section" id="home_get_started_btn">Get Started</a>
        </div>
        @foreach($slides as $slide)
            @if ($loop->index==0)
                <div class="carousel-item active slider-img">
                    <img src="storage/cover_images/{{$slide}}">
                </div>
            @else
                <div class="carousel-item slider-img">
                    <img src="storage/cover_images/{{$slide}}">
                </div>
            @endif
        @endforeach

    </div>

    <a class="carousel-control-prev" href="#slides" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#slides" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@endif