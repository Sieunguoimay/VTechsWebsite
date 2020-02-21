{{-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-quiv="X-UA-Compatible" content="ie-edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>{{config('app_name','VTechs')}}</title>
</head>
<body>
    @include('inc.navbar')
    <div class="container">
        @include('inc.messages')
        @yield('content')
    </div>

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link href="/css/style.css" rel="stylesheet">
    @yield('style')
</head>
<body>
    <div id="app">
        @include('inc.navbar')
        @include('inc.messages')
        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('script')
</body>


<a class="btn back-to-top" style="width:100%;" onclick="topFunction()">Trở về đầu trang</a>
<!--- Footer -->
<footer>
        <div class="container-fluid">
        <div class="row text-center">
            <div class="col-md-4">
                <img src="/storage/cover_images/logo_whitetext_noBackground.png">
                <hr class="light">
                <p>Sđt: <a href="tel: 0343 360584">0343 360584</a></p>
                <p>Email: <a href="mailto: vtechshn@gmail.com">vtechshn@gmail.com</a></p>
                <p>Địa chỉ: Nam Từ Liêm, Hà Nội</p>
            </div>
            <div class="col-md-4">
                <hr class="light">
                <h5>Thời gian làm việc</h5>
                <hr class="light">
                <p>Thứ 2: 8 am to 5 pm</p>
                <p>Saturday: 9 am to 5 pm</p>
                <p>Sunday: closed</p>
            </div>
            <div class="col-md-4">
                <hr class="light">
                <h5>Service Area</h5>
                <hr class="light">
                <p>Monday: Nam Tu Liem, Ha Noi, Viet Nam</p>
                <p>Saturday: Nam Tu Liem, Ha Noi, Viet Nam</p>
                <p>Sunday: Nam Tu Liem, Ha Noi, Viet Nam</p>
            </div>
            <div class="col-12 bottom-most">
                <hr class="light-100">
                <h5>&copy; vtechs.com</h5>
            </div>
        </div>
    </div>
    
</footer>
</html>
