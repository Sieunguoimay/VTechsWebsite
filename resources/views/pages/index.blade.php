@extends('layouts.app')
@section('content')

{{-- <h1>{{$title}}</h1> --}}


@include('inc.slider')

<div class="container-fluid padding">
    <div class="row welcome text-center">
        <div class="col-12">
            <h1 class="display-4">Sản phẩm</h1>
        </div>
        <hr>
        <div class="col-12">
            <p class="lead">Các sản phẩm nổi bật được nhiều khách hàng lựa chọn.</p>
            {{-- <p class="lead">We always strive to deliver best-quality products to you.</p> --}}
        </div>
    </div>
</div>

@include('inc.products_slider')
<br><br>
<!--- Three Column Section -->
{{-- <div class="container-fluid padding TeamContainer">
    <div class="row text-center padding">
        <div class="col-xs-12 col-sm-6 col-md-4">
            <img class="card-img-top" src="storage/cover_images/product.jpg">
            <h3>Product A</h3>
            <p>This is a pragraph</p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <img class="card-img-top" src="storage/cover_images/product.jpg">
            <h3>Product B</h3>
            <p>This is a pragraph</p>
        </div>
        <div class="col-sm-12 col-md-4">
            <img class="card-img-top" src="storage/cover_images/product.jpg">
            <h3>Product C</h3>
            <p>This is a pragraph</p>
        </div>
        <hr class="my-4">
    </div>
</div> --}}


<!--- Two Column Section -->
<div class="container-fluid padding">
    <div class="row">
        <div class="col-lg-6">
            <h2>Lý do lựa chọn chúng tôi</h2>
            <ul>
                <li>VTechs solar panels are engineered to operate flawlessly in real-world environments.</li>
                <li>We ensures your solar panels operate with uncompromised performance and dependable results.</li>
                <li>We delivers more energy over a system’s lifetime, powering your path to more predictable savings.</li>    
            </ul>
            <br>
            <a href="/about" class="btn btn-primary">Read More</a>
        </div>
        <div class="col-lg-6">
            <img src="storage/cover_images/{{$images['whyChooseUs']}}" class="img-fluid">
        </div>
        <hr class="my-4">
    </div>
</div>


<!--- New Posts -->
<div class="container-fluid padding">
    <div class="row text-center">
        <div class="col-12">
            {{-- <h2>Recently Posted</h2> --}}
            <h1 class="display-4">Bài viết gần đây</h1>
        </div>
    </div>
</div>

@include('inc.posts_slider')

<hr class="my-4">

<!--- Two Column Section -->

<div class="container-fluid padding">
    <div class="row padding">
        <div class="col-lg-6">
            <h2>Phương châm làm việc của chúng tôi</h2>
            <p>Continue to be a company that values trust and is trusted by our customers and society.</p>
            
            <p>Archieve sustainable customer satisfaction through the supply of the highest level of analytical technologies and related solutions.</p>
        </div>
        <div class="col-lg-6">
            <img src="storage/cover_images/{{$images['ourPhilosophy']}}" class="img-fluid">
        </div>
    </div>
</div>

<!--- Fixed background -->
<figure>
    <div class="fixed-wrap" >
        <img id="fixed" src="storage/cover_images/{{$images['fixedBackground']}}" class="img-fluid">
    </div>

    <div class="container goodbye text-center">
        <div class="row">
            <div class="col-3"></div>
        <div class="col-6">
            <h1 class="display-4">Quan tâm đến sản phẩm của chúng tôi?</h1>
            <h5 class="card-title"><i>Những sản phẩm chất lượng cao.</i></h5>
            <br>
            <button type="button" class="btn btn-primary btn-lg">Xem toàn bộ</button>
        </div>
        <div class="col-3"></div>
    </div>
    </div>

</figure>


<!--- Connect -->
<div class="container-fluid padding" style="margin-top: 2rem">
    <div class="row text-center padding">
        <div class="col-12">
            {{-- <h2>Connect</h2> --}}
            <h1 class="display-4">Kết nối</h1>
        </div>
        <div class="col-12 social padding">
            <a href="{{$socialMedia['facebook']}}"><i class="fab fa-facebook"></i></a>
            <a href="{{$socialMedia['twitter']}}"><i class="fab fa-twitter"></i></a>
            <a href="{{$socialMedia['google']}}"><i class="fab fa-google-plus-g"></i></a>
            <a href="{{$socialMedia['instagram']}}"><i class="fab fa-instagram"></i></a>
            <a href="{{$socialMedia['youtube']}}"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</div>

@endsection
