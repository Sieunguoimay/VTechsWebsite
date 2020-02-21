{{-- <nav class="navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toogle navigation</span>
                <span clas="icon-bar"></span>
                <span clas="icon-bar"></span>
                <span clas="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{{config('app_name','VTechs')}}</a>
        </div>
        <div class="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="/about">About Us</a></li>
                <li><a href="/products">Products</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/posts/create">Create Post</a></li>
            </ul>   
        </div>
    </div>
</nav> --}}

{{-- 


                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a class="nav-link" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            
                            <li><a class="nav-link" href="/dashboard">Dashboard</a></li>
                            <li>
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif --}}
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
    <div class="container-fluid">

        <a class="navbar-brand" href="/"><img src="/storage/cover_images/head_logo.png" style="max-width: 170px"></a>

        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Branding Image -->
            {{-- <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a> --}}

        </div>
		
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Trang chủ</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/products">Sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">Về chúng tôi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Liên hệ</a>
                </li>

                

            </ul>
        </div>
    </div>
</nav>
