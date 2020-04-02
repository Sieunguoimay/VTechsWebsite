<ul class="list-unstyled">
    <li> <a href="/products" class="text-dark"><strong>Tất cả sản phẩm</strong></a>
        <ul style="list-style-type: none;padding-left:1em">
        @if(count($categories)>0)
        @foreach($categories as $category)
        <li><a href="products?category_id={{$category->id}}" class="text-dark" 
            @if($category->selected)
            style="font-weight:bold"
            @endif
            >{{$category->name}}</a></li>
        @endforeach
        @endif
        </ul>
    </li>
</ul>