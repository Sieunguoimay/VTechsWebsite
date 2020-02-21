
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

</head>
<body>

    <div class="container">
        <div class="row">
            @if(count($images)>0)
                @foreach ($images as $image)
                <div class="col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-img-top">
                        <img src="/storage/cover_images/{{$image['name']}}" class="img-fluid">
                        </div>
                        <div class="card-block mask flex-center">
                            <small class="card-text">{!!$image['size'][0]!!}x{!!$image['size'][1]!!}</small>
                            <p class="card-text">{!!$image['original_name']!!} </p>
                            <button style="margin:10px;" class="btn btn-success" onclick="returnFileUrl('/storage/cover_images/{{$image['name']}}')">Select</button>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
    <script>
        // Helper function to get parameters from the query string.
        function getUrlParam( paramName ) {
            var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
            var match = window.location.search.match( reParam );

            return ( match && match.length > 1 ) ? match[1] : null;
        }
        // Simulate user action of selecting a file to be returned to CKEditor.
        function returnFileUrl(url) {

            var funcNum = getUrlParam( 'CKEditorFuncNum' );
            window.opener.CKEDITOR.tools.callFunction( funcNum, url );
            window.close();
        }
    </script>
</body>
</html>
