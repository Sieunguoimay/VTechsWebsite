@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<style>
body{
}
.container-fluid.home-page{
    background-color:#f2f2f2; 
    padding: 1.5rem 2rem;
}
.container-fluid.home-page .card.big-card{
    border:none;
}
</style>
@endsection
@section('content')

{{-- <h1>{{$title}}</h1> --}}


@include('inc.slider')

<div class="container-fluid home-page">
    <div class="card big-card">
    <div class="card-title text-center pt-2 border-bottom" id="home_news_section">
        <h1 class="display-5">Tin tức</h1>
    </div>

@if(count($news)>0)
    <div class="card-body row">
        @foreach($news as $n)
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            {{-- data-aos="fade-up" --}}
            <div class="blog-post">
                <div class="col-12 blog-post__img">
                    <img src="/storage{{$n->cover_image}}" alt="{{$n->title}}">
                </div>
                <div class="col-12 p-0">
                    <div class="blog-post__date">
                        <span>{{$n->created_at->diffForHumans()}}</span>
                    </div>
                    <a  href="/posts/{{$n->id}}" class="blog-post__title">{{$n->title}}</a>
                    <p class="blog-post__text">
                        {{strip_tags(str_limit($n->body,125))}}
                    </p>
                    <a  href="/posts/{{$n->id}}" class="blog-post__cta">Đọc tiếp</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    <div class="row text-center">
        <div class="col-12">
            <a href="/news" class="home-page__button">Xem thêm >></a> 
        </div>
    </div>
@endif
    </div>
</div>




<!--- Two Column Section -->
<div class="container-fluid home-page">
    <div class="card p-2 big-card">
        <div class="row">
        <div class="col-lg-6">
            <h2>Lý do lựa chọn chúng tôi</h2>
            <ul>
                <li>Tấm pin năng lượng mặt trời của VTechs được thiết kế để làm việc bền bỉ trong môi trường khí hậu của Việt Nam.</li>
                {{-- <li>VTechs solar panels are engineered to operate flawlessly in real-world environments.</li> --}}
                <li>Pin được đảm bảo hoạt động với hiệu xuất cao và nguồn điện ổn định.</li>
                {{-- <li>We ensures your solar panels operate with uncompromised performance and dependable results.</li> --}}
                <li>Pin có khả năng chuyển hóa nhiều hơn nguồn năng lượng trong suốt quãng đời hoạt động, cho phép bạn tiết kiệm nhiều hơn.</li>
                {{-- <li>We delivers more energy over a system’s lifetime, powering your path to more predictable savings.</li>     --}}
            </ul>
            <br>
            <a href="/about" class="btn btn-primary">Đọc tiếp</a>
        </div>
        <div class="col-lg-6" data-aos="fade-left" data-aos-duration="800">
            <img src="storage/cover_images/{{$images['whyChooseUs']}}" class="img-fluid">
        </div>
    </div>
    </div>
</div>


<!--- New Posts -->
<div class="container-fluid home-page">
    <div class="card py-2 text-center big-card">
        <div class="card-title pt-2 border-bottom"  id="home_posts_section">
            {{-- <h1 class="display-5">Bài viết gần đây</h1> --}}
            <h1 class="display-5">Giải pháp về điện năng lượng mặt trời</h1>
        </div>
        <div class="card-body">
            @include('inc.posts_slider')
        </div>
    </div>

</div>

<!--<div class="container-fluid padding">-->
<!--    <div class="row text-center">-->
<!--        <div class="col-12">-->
<!--            <a href="/writings" class="home-page__button">Xem thêm >></a> -->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--- Two Column Section -->

<div class="container-fluid home-page">
    <div class="card p-2 big-card">
        <div class="row"> 
        <div class="col-lg-6">
            <h2>Phương châm làm việc của chúng tôi</h2>
            <ul>
                <li>Tiếp tục nỗ lực là một công ty đáng tin cậy của khách hàng cũng như của cộng đồng.</li>
                <li>Hướng tới mục tiêu là sự hài lòng bền vững từ khách hàng thông qua việc cung cấp sản phẩm với chất lượng ở mức cao nhất của công nghệ điện mặt trời và các giải pháp hệ thống.</li>
            </ul>
            {{-- <p>Continue to be a company that values trust and is trusted by our customers and society.</p> --}}
            
            {{-- <p>Archieve sustainable customer satisfaction through the supply of the highest level of analytical technologies and related solutions.</p> --}}
        </div>
        <div class="col-lg-6">
            <img src="storage/cover_images/{{$images['ourPhilosophy']}}" class="img-fluid" data-aos="fade-left" data-aos-duration="800">
            
            {{-- data-aos="fade-down" data-aos-easing="linear" data-aos-duration="800" --}}
        </div>
        </div>
    </div>
</div>

<div class="container-fluid home-page">
    <div class="card p-2 big-card">
        <div class="card-title text-center pt-2 border-bottom"  id="home_products_section">
            <h1 class="display-5">Sản phẩm</h1>
        </div>
        {{-- <div class="col-12">
            <p class="lead">Các sản phẩm nổi bật được nhiều khách hàng lựa chọn.</p>
        </div> --}}
            {{-- <p class="lead">We always strive to deliver best-quality products to you.</p> --}}
        <div class="card-body">
            @include('inc.products_slider')
        </div>
    </div>
</div>
<div class="container-fluid home-page">
    {!!$capacity_form!!}
</div>

<!--- Fixed background -->
<figure>
    <div class="fixed-wrap" >
        <img id="fixed" src="storage/cover_images/{{$images['fixedBackground']}}" class="img-fluid" >
    </div>

    <div class="container goodbye text-center">
        <div class="row">
            <div class="col-3"></div>
        <div class="col-6">
            <h1 class="display-4">Quan tâm đến sản phẩm của chúng tôi?</h1>
            <h5 class="card-title"><i>Những sản phẩm chất lượng cao.</i></h5>
            <br>
            <a type="button" class="btn btn-primary btn-lg" href="/products">Xem toàn bộ</a>
        </div>
        <div class="col-3"></div>
    </div>
    </div>

</figure>


<!--- Connect -->
<div class="container-fluid padding  home-page">
    <div class="row text-center padding">
        <div class="col-12">
            {{-- <h2>Connect</h2> --}}
            <h1 class="display-4">Kết nối</h1>
        </div>
        @include('inc.social')
    </div>
</div>

@endsection

@section('script')
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
  SendNewViewToServer('home');
</script>
@endsection

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
