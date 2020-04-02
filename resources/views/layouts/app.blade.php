<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pin Năng Lượng Mặt Trời VTechs</title>
    
    
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fingerprintjs2/2.1.0/fingerprint2.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fingerprintjs2/1.5.0/fingerprint2.min.js"></script>
    <link href="/css/style.css" rel="stylesheet">
    

    @yield('style')

</head>
<body>
        
    <div id="fb-root"></div>
    <div id="app">
        @include('inc.navbar')
        @include('inc.messages')
        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    
    @yield('script')

    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v6.0&appId=799659427166307&autoLogAppEvents=1"></script>
</body>


<a class="btn back-to-top" style="width:100%;" onclick="topFunction()">Trở về đầu trang</a>
<!--- Footer -->
<footer>
        <div class="container-fluid">
        <div class="row text-center">
            <div class="col-md-4">
                <img src="/storage/logos_and_icons/logo_whitetext_noBackground.png">
                <hr class="light">
                <p>Điện thoại: <a href="tel:0343-360-584">0343-360-584</a></p>
                <p>Email: <a href="mailto:vtechshn@gmail.com">vtechshn@gmail.com</a></p>
                <p>Địa chỉ: Số 21, Ngõ 28/8, Đại Linh, Trung Văn</p><p>Nam Từ Liêm, Hà Nội</p>
            </div>
            <div class="col-md-4">
                <hr class="light">
                <h5>Thời gian làm việc</h5>
                <hr class="light">
                <p>Thứ 2 - Thứ 6: 8 am đến 5 pm</p>
                <p>Thứ 7: 9 am đến 5 pm</p>
                <p>Chủ nhật: đóng cửa</p>
            </div>
            <div class="col-md-4">
                <hr class="light">
                <h5>Khu vực hoạt động</h5>
                <hr class="light">
                <p>Toàn Tp. Hà Nội</p>
            </div>
            <div class="col-12 bottom-most">
                <hr class="light-100">
                <h5>&copy; vtechs.vn</h5>
            </div>
        </div>
    </div>
    
</footer>
</html>
