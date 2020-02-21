@extends('layouts.app')
@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action'=>['PostsController@update',$post->id],'method'=>'POST','enctype'=>'multipart/form-data'])!!}
        {{ method_field('PUT') }}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'Title'])}}
        </div> 
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body',$post->body,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body Text'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close()!!}
@endsection

@section('script')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('article-ckeditor', {
        filebrowserBrowseUrl : '/ckeditor/browse',
        filebrowserUploadUrl : '/ckeditor/upload',
        filebrowserImageBrowseUrl : '/ckeditor/image_browse',
        filebrowserImageUploadUrl : '/ckeditor/image_upload',
        filebrowserWindowWidth  : 800,
        filebrowserWindowHeight : 500
    });
</script>
@endsection