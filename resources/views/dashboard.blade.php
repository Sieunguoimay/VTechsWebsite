@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-2">
            <div class="panel panel-default">
                <h3>Dashboard</h3>

                <div class="panel-body">
                    <div class="row">
                        <h4 class="col-9">Your Posts</h4>
                        <div class="col-3">
                            <a href="/posts/create" class="btn btn-primary">Create Post</a>
                        </div>
                    </div>
                    @if(count($posts)>0)
                    <table class="table table-striped">
                        <tr>
                            <th>Photos</th>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Last update</th>
                        </tr>
                        @foreach ($posts as $post)
                            <tr>
                                <td><img src="/storage/cover_images/{{$post->cover_image}}" style="max-width: 100px;"></td>
                                <td><a href="posts/{{$post->id}}">{{$post->title}}</a></td>
                                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-secondary">Edit</a></td>
                                <td>
                                    {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!}
                                        {{ method_field('DELETE') }}
                                        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                                <td>{{$post->created_at}}</td>
                            </tr>
                        @endforeach
                    </table>
                    @endif
                </div>
                <hr class="my-4">
                <br><br><br>
                <div class="panel-body">
                    <div class="row">
                        <h4 class="col-9">Your Products</h4>
                        <div class="col-3">
                            <a href="/products/create" class="btn btn-primary">Create Product</a>
                        </div>
                    </div>
                    @if(count($products)>0)
                    <table class="table table-striped">
                        <tr>
                            <th>Photos</th>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Last update</th>
                        </tr>
                        @foreach ($products as $product)
                            <tr>
                                <td><img src="/storage/cover_images/{{$product->cover_image}}" style="max-width: 100px; max-height:50px"></td>
                                <td><a href="/products/{{$product->id}}">{{$product->name}}</a></td>
                                <td><a href="/products/{{$product->id}}/edit" class="btn btn-secondary">Edit</a></td>
                                <td>
                                    {!!Form::open(['action'=>['ProductsController@destroy',$product->id],'method'=>'POST','class'=>'pull-right'])!!}
                                        {{ method_field('DELETE') }}
                                        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                                <td>{{$product->created_at}}</td>
                            </tr>
                        @endforeach
                    </table>
                    @endif
                </div>
                <hr class="my-4">

            </div>
        </div>
    </div>
</div>
@endsection
