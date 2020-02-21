@extends('layouts.app')
@section('style')
<style>
.card-img-top {
    width: 100%;
    height: 15vw;
    object-fit: cover;
}
</style>
@endsection

@section('content')
<a href="/posts" class="btn btn-default">Go back</a>

<div class="container">
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <h1>{{$post->title}}</h1>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6" style="padding: 0 !important;">
                        <small>Written {{$post->created_at->diffForHumans()}}</small>
                    </div>
                    <div class="col-sm-6 text-right"  style="padding: 0 !important;">
                        @include('inc.share_button')
                    </div>
                </div>
            </div>
            <hr>
            <br><br>
            <img style="width:100%;" src="/storage/cover_images/{{$post->cover_image}}">    
            <br><br>
            
            <div class="post">
                {!!$post->body!!}
            </div>
            <br><br>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6" style="padding: 0 !important;">
                        <small>Written {{$post->created_at->diffForHumans()}}</small>
                    </div>
                    <div class="col-sm-6 text-right"  style="padding: 0 !important;">
                        @include('inc.share_button')
                    </div>
                </div>
                @if(!Auth::guest())
                    @if(Auth::user()->id===$post->user_id)
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
                        </div>
                        <div class="col-sm text-right">                        
                            {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!}
                                {{ method_field('DELETE') }}
                                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                            {!!Form::close()!!}
                        </div>
                    </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="col-sm-2">
        </div>
    </div>
</div>
<br>
<br>
<br>
<div class="container padding">
    <h3>More Posts</h3>
</div>
@include('inc.posts_slider')
<br>
<br>
@endsection

@section('script')
<!-- Go to www.addthis.com/dashboard to customize your tools --> 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e4ceb7df483e26a"></script>

@endsection
