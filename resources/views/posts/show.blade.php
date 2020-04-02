@extends('layouts.app')
@section('style')
<style>
.card-img-top {
    width: 100%;
    height: 15vw;
    object-fit: cover;
}

.post img{
    width:100% !important;
    height: auto !important;
}
</style>
<meta property="og:site_name" content="VTechs">
<meta property="og:url" content="{{Request::url()}}">  
<meta property="og:type" content="website"> 
<meta property="og:type" content="article">
<meta property="og:title" content="{{$post->title}}">
<meta property="og:description" content="{{strip_tags(str_limit($post->body,64))}}">
<meta property="og:image" content="http://vtechs.vn/storage/{{$post->cover_image}}">
<meta property="fb:app_id" content="799659427166307">
@endsection

@section('content')
{{-- <a href="/posts" class="btn btn-default">Go back</a> --}}
<br><br>

<div class="container">
    @if(!Auth::guest())
        @if(Auth::user()->id===$post->user_id)

        <div class="row">
            <div class="col-sm-10  m-0 p-0"></div>
            <div class="col-sm-2  m-0 p-0">
                <div class="container">
                    <div class="row">
                        <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
                        {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!}
                            {{ method_field('DELETE') }}
                            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>

        @endif
    @endif
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <h1>{{$post->title}}</h1>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6" style="padding: 0 !important;">
                        <small>Đăng {{$post->created_at->diffForHumans()}}</small>
                    </div>
                    <div class="col-sm-6 text-right"  style="padding: 0 !important;">
                        @include('inc.share_button')
                    </div>
                </div>
            </div>
            <hr>
            <br><br>
            <img style="width:100%;" src="/storage/{{$post->cover_image}}">    
            <br><br>
            
            <div class="post">
                {!!$post->body!!}
            </div>
            <br><br>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6" style="padding: 0 !important;line-height: 10px;">
                        <p class="mb-0 text-muted">
                            <img src="/storage/logos_and_icons/eye.png" style="height:20px;margin-bottom:4px;">
                            {{count($post->views)}} lượt xem</p>
                        <small>Đăng {{$post->created_at->diffForHumans()}}</small>
                    </div>
                    <div class="col-sm-6 text-right"  style="padding: 0 !important;">
                        @include('inc.share_button')
                    </div>
                </div>

                
            </div>
        </div>
        <div class="col-sm-2">
        </div>
    </div>
</div>
<br><br><br>
<div class="container">
    <h3>Có thể bạn quan tâm</h3>
</div>
@include('inc.posts_slider')
@endsection

@section('script')
<script>
    SendNewViewToServer('post',{{$post->id}});
</script>

@endsection
