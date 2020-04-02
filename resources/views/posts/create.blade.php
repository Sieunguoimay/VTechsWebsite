@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
    <h1>Create Post</h1>
    {!! Form::open(['action'=>'PostsController@store','method'=>'POST','enctype'=>'multipart/form-data'])!!}
        <label>Category</label>
        <select id="categories" name="category">
            @if(count($categories)>0)
            @foreach($categories as $category)
            <option value="{{$category}}">{{$category}}</option>
            @endforeach
            @endif
        </select>

        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
        </div> 
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body Text'])}}
        </div>
        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}
        <div class="form-group">
            <strong>Cover Image </strong>
            <input type='file' id="imgInp" name="cover_image" />
            <img id="blah" src="/storage/uploaded_images/noimage.jpg" alt="your image" style="max-width: 100px; max-height:50px"/>
        </div>

        <div class="form-group">
            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
            <a href="/dashboard" class="btn btn-danger">Cancel</a>
        </div>
    {!! Form::close()!!}
</div>
</div>
</div>
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
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function() {
    readURL(this);
});
</script>
@endsection