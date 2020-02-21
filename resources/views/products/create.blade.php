@extends('layouts.app')
@section('content')
<div class="container padding">
    <div class="row">
        <div class="col-sm-12">
        <h1>Create Product</h1>
    {{-- {!! Form::open(['action'=>'CKEditorController@image_upload','method'=>'POST','enctype'=>'multipart/form-data'])!!}
        <p><strong>Upload product photos:</strong> 
            {{Form::file('upload')}}
            {{Form::submit('Upload',['class'=>'btn btn-primary'])}}
        </p>
    {!! Form::close()!!} --}}
        <form method="post" id="upload_form", enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="file" name="select_file" id="select_file"/>
                <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"/>
            </div>
        </form>
        <span id="uploaded_image"></span>

        {!! Form::open(['action'=>'ProductsController@store','method'=>'POST','enctype'=>'multipart/form-data'])!!}
            <input type="hidden" id="product_photo" name="product_photo" value="">
            <div class="form-group">
                {{Form::label('name','Name')}}
                {{Form::text('name','',['class'=>'form-control','placeholder'=>'Name'])}}
            </div> 
            <div class="form-group">
                {{Form::label('price','Price')}}
                {{Form::text('price','',['class'=>'form-control','placeholder'=>'Price'])}}
            </div> 
            <div class="form-group">
                {{Form::label('quantity','Quantity')}}
                {{Form::number('quantity','',['class'=>'form-control','placeholder'=>'Quantity'])}}
            </div> 
            <div class="form-group">
                {{Form::label('description','Description')}}
                {{Form::textarea('description','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Description'])}}
            </div>
            <div class="form-group">

            </div>
            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
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
$(document).ready(function(){
    $('#upload_form').on('submit',function(event){
        event.preventDefault();
        $.ajax({
            url:"{{route('products.store_photo')}}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                
                $("#message").css('display','block');
                $("#message").html(data.message);
                $("#message").addClass(data.class_name);
                $("#uploaded_image").html(data.uploaded_image_html);
                $("#product_photo").val(data.uploaded_image)
            }
            
        });
    });
    $('#product_form').on('submit',function(event){
        setFormSubmitting();
    });
});

var formSubmitting = false;
var setFormSubmitting = function() { formSubmitting = true; };
window.onbeforeunload = function(){
    if(!formSubmitting){
        return "Your changes have not been saved.";
    }
}
</script>
@endsection

{{-- $.ajax({
    url:"/products/store_photo",
    method:"GET", 
    data:form_data,
    contentType:false,
    cache:false,
    processData:false,
    beforeSend:function(){
        $("#uploaded_image").html("<label class='text-success'>Image Uploading...</label>");
    },
    success:function(data){
        $("#uploaded_image").html(data);
    }              
 }); 
 
 
     $(document).on("change", "#file", function(e) {
        var property = document.getElementById("file").files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        if(jQuery.inArray(image_extension),['gif','png','jpg','jpeg']==-1){
            alert("Invalid image file");
        }
        var image_size = property.size;
        if(image_size>2000000){
            alert("Image file size is very big");
        }else{
            var form_data = new FormData();
            form_data.append("file",property);

            $.post("/products/store",
            {
                name: "Donald Duck",
                city: "Duckburg"
            },
            function(data, status){
                alert("Data: " + data + "\nStatus: " + status);
            });
        }

    });



    <form method="post" id="upload_form", enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="file" name="select_file" id="select_file"/>
            <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"/>
        </div>
    </form>
    <span id="uploaded_image"></span>

        $('#upload_form').on('submit',function(event){
        event.preventDefault();
        $.ajax({
            url:"{{route('products.store_photo')}}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                
                $("#message").css('display','block');
                $("#message").html(data.message);
                $("#message").addClass(data.class_name);
                $("#uploaded_image").html(data.uploaded_image);
                
            }
            
        });
    });
 --}}
