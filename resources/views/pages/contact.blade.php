@extends('layouts.app')
@section('style')
<style>
    .mapouter{
        position:relative;
        text-align:right;
        height:500px;
        width:100%;
    }
    .gmap_canvas {
        overflow:hidden;
        background:none!important;
        height:500px;
        width:100%;
    }
    .contact .social{
        padding:0;
    }
    .contact .social a{
        margin-right:10px;
        padding:0;
        font-size: 2em;
    }
</style>

@endsection
@section('content')

    <br><br><br>
    <div class="container padding">
        <div class="row">
            <div class="col-md-12">
                <h1>Liên hệ với chúng tôi</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">

                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Ng%C3%B5%2028%2F8%2C%20%C4%90%E1%BA%A1i%20Linh%2C%20Trung%20V%C4%83n%2C%20Nam%20T%E1%BB%AB%20Li%C3%AAm%2C%20H%C3%A0%20N%E1%BB%99i&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                        </iframe>
                        <a href="https://www.embedgooglemap.net/blog/divi-discount-code-elegant-themes-coupon/">elegantt</a>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <p>Liên hệ với chúng tôi để nhận được những dịch vụ và sản phẩm tốt nhất trực tiếp tại địa chỉ: 
                <a href="http://maps.google.com/?q=Ngõ 28/8, Đại Linh, Trung Văn, Nam Từ Liêm, Hà Nội"> 
                    <strong>Công ty TNHH Vtechs Việt Nam</strong>, Số 21, Ngõ 28/8, Đại Linh, Trung Văn, Nam Từ Liêm, Hà Nội.</p>
                </a>
                <p>Hoặc liên hệ online 24/24 thông qua:</p>
                <ul>
                    <li><p>Sđt: <a href="tel: 0343 360584">0343 360584</a></p></li>
                    <li><p>Email: <a href="mailto: vtechshn@gmail.com">vtechshn@gmail.com</a></p></li>
                </ul>
                <p>Chúng tôi luôn có mặt để phản hồi lại yêu cầu từ quý khách.</p>
                <p> <strong>Công ty TNHH Vtechs Việt Nam</strong> cam kết uy tín, chất lượng và tư vấn tận tình cho gia đình bạn.</p>

                <div class="container-fluid">
                    <div class="row contact">
                        {{-- <div class="col-12 contact-social p-0">
                            <a href="{{$socialMedia['facebook']}}"><i class="fab fa-facebook"></i></a>
                            <a href="{{$socialMedia['twitter']}}"><i class="fab fa-twitter"></i></a>
                            <a href="{{$socialMedia['google']}}"><i class="fab fa-google-plus-g"></i></a>
                            <a href="{{$socialMedia['instagram']}}"><i class="fab fa-instagram"></i></a>
                            <a href="{{$socialMedia['youtube']}}"><i class="fab fa-youtube"></i></a>
                        </div> --}}
                        
                        @include('inc.social')
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>SendNewViewToServer('contact',0);</script>
@endsection
