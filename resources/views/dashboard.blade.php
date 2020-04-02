@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <h3>Dashboard</h3>
                <div class="card p-2">
                    <p >Admin: {{auth()->user()->name}}</p>
                    <p>Registered: {{auth()->user()->created_at}}</p>
                    <p>Email: {{auth()->user()->email}}</p>
                </div>
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
                            <th>Category</th>
                            <th><a href="#">Views ({{$posts->sum('views_count')}})</a></th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Last update</th>
                        </tr>
                        @foreach ($posts as $post)
                            <tr>
                                <td><img src="/storage/{{$post->cover_image}}" style="max-width: 100px;"></td>
                                <td><a href="posts/{{$post->id}}">{{$post->title}}</a></td>
                                <td>{{$post->category}}</td>
                                <td><a href="{{route('views',['object_type'=>'post','object_id'=>$post->id])}}">{{$post->views_count}}</a></td>
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
                            <th>Category</th>
                            <th><a href="#">Views ({{$products->sum('views_count')}})</a></th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Last update</th>
                        </tr>
                        @foreach ($products as $product)
                            <tr>
                                <td><img src="/storage/{{$product->cover_image}}" style="max-width: 100px; max-height:50px"></td>
                                <td><a href="/products/{{$product->id}}">{{$product->name}}</a></td>
                                <td><a href="{{route('products.index',['category_id'=>$product->category_id])}}">{{$product->category->name}}</a></td>
                                <td><a href="{{route('views',['object_type'=>'product','object_id'=>$product->id])}}">{{$product->views_count}}</a></td>
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
                <br><br><br>
                <div class="panel-body">
                    <div class="row">
                        <h4 class="col-9">All Users</h4>
                    </div>
                    @if(count($users)>0)
                    <table class="table table-striped">
                        <tr>
                            <th>Avatar</th>
                            <th>User name</th>
                            <th>Email</th>
                            <th>Admin</th>
                            <th>Registered date</th>
                            <th>Delete</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td><img src="{{$user->avatar}}" style="max-width: 100px; max-height:50px"></td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td><!-- Material switch -->
                                    <input type="checkbox" onclick="return false;" @if($user->is_admin) checked @endif>
                                </td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    {!!Form::open(['action'=>['DashboardController@delete_user',$user->id],'method'=>'POST','class'=>'pull-right'])!!}
                                        {{ method_field('DELETE') }}
                                        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @endif
                </div>
                <hr class="my-4">
                <br><br><br>
                <div class="panel-body">
                    <div class="row">
                        <h4 class="col-9">Orders</h4>
                    </div>
                    <div class="row">
                        <a class="btn btn-primary" href="/show_orders">Show all orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


