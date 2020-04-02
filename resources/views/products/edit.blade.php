@extends('layouts.app')
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.8/css/fileinput-rtl.min.css"/>
@endsection
@section('content')
<div class="container padding">
    <div class="row">
        <div class="col-sm-12">
        <h1>Create Product</h1>
        <div class="file_upload_section">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <input type="file" id="file-1" name="select_file" multiple class="file" data-overwrite-initial="false" data-min-file-count="1">
            </div>
        </div>
        @if(count($product->photos)>0)
        <div class="container">
            <div class="row">
            @foreach($product->photos as $photo)
            <div class="col-12">
                <img src="/storage/{{$photo->path}}" style="max-width:100px"/>
                <button onclick="deletePhoto(this)">Delete</button>
            </div>
            @endforeach
        </div>
        </div>
        @endif

        {!! Form::open(['action'=>['ProductsController@update',$product->id],'method'=>'POST','enctype'=>'multipart/form-data'])!!}
            {{ method_field('PUT') }}
            {{-- <div class="form-group" id="image_upload_container">
                <strong>Cover Image </strong>
                <input required type='file' name="product_photos[]"  class="query_selector" multiple/>
                <img src="/storage/cover_images/noimage.jpg" alt="your image" style="max-width: 100px; max-height:50px"/>
            </div> --}}
            {!!$category_selector!!}
            <input id="photos_container" type="hidden" name="product_photos" value="@foreach($product->photos as $photo){{$photo->path}};@endforeach">
            <div class="form-group">
                {{Form::label('name','Name')}}
                {{Form::text('name',$product->name,['class'=>'form-control','placeholder'=>'Name'])}}
            </div> 
            <div class="form-group">
                {{Form::label('price','Price')}}
                {{Form::text('price',$product->list_price,['class'=>'form-control','placeholder'=>'Price'])}}
            </div> 
            <div class="form-group">
                {{Form::label('quantity','Quantity')}}
                {{Form::number('quantity',$product->quantity,['class'=>'form-control','placeholder'=>'Quantity'])}}
            </div> 
            <div class="form-group">
                {{Form::label('description','Description')}}
                {{Form::textarea('description',$product->description,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Description'])}}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.8/js/fileinput.min.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('article-ckeditor', {
        filebrowserBrowseUrl : '/ckeditor/browse',
        filebrowserUploadUrl : '/ckeditor/upload',
        filebrowserImageBrowseUrl : '/ckeditor/image_browse',
        filebrowserImageUploadUrl : '/ckeditor/image_upload',
        filebrowserWindowWidth  : 800,
        filebrowserWindowHeight : 500
    });


$('#file-1').fileinput({
    theme:'fa',
    uploadUrl:"/products/store_multiple_photos",
    uploadExtraData:function(){
        return {
            _token:$("input[name='_token']").val()
        };
    },allowedFileExtensions:['jpg','png','gif','jpeg'],
    overwriteInitial:false,
    maxFileSize:10240,
    maxFileNum:10,
    slugCallback:function(fileName){
        return fileName;//.replace('(','_').replace(']','_');
    }
});

$('#file-1').on('fileuploaded', function(event, data, previewId, index) {
    var value = $('#photos_container').val()+";"+data.response.uploaded;
    // if(value)
    //     value+=";"+data.response.uploaded;
    // else
    //     value = data.response.uploaded
    // console.log(value);
    $('#photos_container').val(value);
}); 
function deletePhoto(element){
    var x = element.parentNode.firstChild.src.replace(/^.*[\\\/]/, ''); // strips hashes, too
    x = x.replace('%20',' ');
    var y = $('#photos_container').val().replace('/uploaded_images/'+x,'');
    $('#photos_container').val(y);
    // console.log('/uploaded_images/'+x);
    // console.log(y);
    element.parentNode.parentNode.removeChild(element.parentNode);
}
</script>
@endsection
