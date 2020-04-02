@extends('layouts.app')
@section('content')
<br><br><br>
<div class="container-fluid">

    <div class="row">
    <div class="col-12 pb-3 pt-4 border-top">
        <h1 style="line-height: 0.5em;">{{$title}}</h1>
    </div>
            {{-- <small>Các sản phẩm bán chạy nhất. Được cập nhập từng giờ.</small> --}}
            @if (count($posts)>0)
            @foreach ($posts as $post)
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="blog-post">
                    <div class="blog-post__img">
                        <img src="/storage{{$post->cover_image}}" alt="{{$post->title}}">
                    </div>
                    <div class="blog-post__info">
                        <div class="blog-post__date">
                            <span>{{$post->created_at->diffForHumans()}}</span>
                        </div>
                            <a class="blog-post__title"   href="/posts/{{$post->id}}">{{$post->title}}</a>
                        <p class="blog-post__text">
                            {{strip_tags(str_limit($post->body,125))}}
                        </p>
                        <a  href="/posts/{{$post->id}}" class="blog-post__cta">Đọc tiếp</a>
                    </div>
                </div>
            </div>
        @endforeach
        {{$posts->links()}} 
    @else
    <p>No posts found</p>
    @endif
</div>
</div>
<br><br>

@endsection
{{-- 
<div class="card h-100 border-0">
    <div class="row m-0">
        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-12 p-0" >
            <a href="/posts/{{$post->id}}">
            <img class="img-fluid"src="/storage/{{$post->cover_image}}">
            </a>
        </div>
        <div class="col-xs-6 col-lg-6 col-md-6 col-sm-12">
            <h3><a href="/posts/{{$post->id}}" class="text-dark">{{$post->title}}</a></h3>
            <small>Written {{$post->created_at->diffForHumans()}}</small>
            <p>{{strip_tags(str_limit($post->body,125))}}</p>
            <a href="/posts/{{$post->id}}" class="text-dark">
            <img style="width:15px; margin-bottom:4px" src="/storage/logos_and_icons/triangle_icon.jpg">
            Đọc tiếp</a>
        </div>
    </div>
</div> --}}
