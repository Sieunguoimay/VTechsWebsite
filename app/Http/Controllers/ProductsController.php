<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Product;
use App\ProductPhoto;
use App\Category;
use App\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator;
use DB; 
class ProductsController extends Controller
{
    private $categoriesController;
    private $viewsController;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
        $this->categoriesController = new CategoriesController();
        $this->viewsController = new ViewsController();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        // $this->viewsController->store_view('product_page',0,request()->path());
        if(request()->has('category_id')){
            try{
                $products = Product::where('category_id','=',request()->category_id)->paginate(12);
                $categoriesList = $this->categoriesController->index(request()->category_id);
            }catch(\Exception $e){
                $products = Product::orderBy('created_at','desc')->paginate(12);
                $categoriesList = $this->categoriesController->index();
            }
        }else{
            $products = Product::orderBy('created_at','desc')->paginate(12);
            $categoriesList = $this->categoriesController->index();
        }
        $posts = Post::orderBy(DB::raw('RAND()'))->take(3)->get();
        return view('products.index')->with([
            'products'=>$products,
            'posts'=>$posts,
            'categories_list'=>$categoriesList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create')->with('category_selector',$this->categoriesController->select());
    }

 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productPhotos = preg_split('@;@', $request->input('product_photos'), NULL, PREG_SPLIT_NO_EMPTY);
        // explode ('@;@',$request->input('product_photos'));

        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->list_price = $request->input('price');
        try{
            $product->category_id = $request->category;
        }catch(\Exception $e){
            echo $e;            
        }
        $product->quantity = $request->input('quantity');
        $product->cover_image = count($productPhotos)>0?$productPhotos[0]:"/uploaded_images/noimage.jpg";
        $product->user_id = auth()->user()->id;
        $product->save();

            
        if(count($productPhotos)>0){
            foreach($productPhotos as $p){
                $product_photo = new ProductPhoto();
                $product_photo->path = $p;
                $product_photo->product_id = $product->id;
                $product_photo->save();    
            }
        }
        return redirect('/dashboard')->with('success','New Product Created');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_photo(Request $request)
    {
        $validation = Validator::make($request->all(),['select_file'=>'required|image|mimes:jpeg,png,jpg,gif|max:10000']);
        if($validation->passes()){

            //Get filename with the extension
            $filenameWithExt = $request->file('select_file')->getClientOriginalName();

            //Get just filename
            $filename = pathInfo($filenameWithExt,PATHINFO_FILENAME);
            //GetJust extension
            $extension = $request->file('select_file')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('select_file')->storeAs('public/uploaded_images',$fileNameToStore);



            return response()->json([
                'message'=>'Image Uploaded Successfully',
                'uploaded_image_html'=>'<img src="/storage/uploaded_images/'.$fileNameToStore.'" class="img-thumbnail rounded-circle" width="300"/>',
                'uploaded_image'=>$fileNameToStore,
                'class_name'=>'alert-success'
            ]);
        }else{
            return response()->json([
                'message'=>$validation->errors()->all(),
                'uploaded_image'=>'',
                'class_name'=>'alert-danger'
            ]);
        }
    }

    public function store_multiple_photos(Request $request){
        $validation = Validator::make($request->all(),['select_file'=>'required|image|mimes:jpeg,png,jpg,gif|max:10240']);
        if($validation->passes()){

            //Get filename with the extension
            $filenameWithExt = $request->file('select_file')->getClientOriginalName();

            //Get just filename
            $filename = pathInfo($filenameWithExt,PATHINFO_FILENAME);
            //GetJust extension
            $extension = $request->file('select_file')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('select_file')->storeAs('/public/uploaded_images',$fileNameToStore);



            return response()->json(['uploaded'=>'/uploaded_images/'.$fileNameToStore]);
        }else{
            return response()->json([
                'message'=>$validation->errors()->all(),
                'uploaded_image'=>'',
                'class_name'=>'alert-danger'
            ]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $products = Product::orderBy(DB::raw('RAND()'))->take(5)->get();
        $product = Product::findOrFail($id);
        $product_photos = $product->photos;
        if($product->category==null){
            $product->category = new Category();
            $product->category->id = 0;
            $product->category->name = 'Not specified';
        }
        $product->views = $this->viewsController->getViews('product',$id);
        return view('products.show')->with([
            'product'=>$product,
            'products'=>$products,
            'product_photos'=>$product_photos
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        if(auth()->user()->id!=$product->user_id){
            return back()->with('error','Unauthorized');
        }
        $categorySelector = $this->categoriesController->select($product->category_id);
        return view('products.edit')->with(['product'=>$product,'category_selector'=>$categorySelector]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $productPhotos = preg_split('@;@', $request->input('product_photos'), NULL, PREG_SPLIT_NO_EMPTY);

        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->list_price = $request->input('price');
        $product->category_id = $request->category;
        $product->quantity = $request->input('quantity');
        $product->cover_image = count($productPhotos)>0?$productPhotos[0]:"/uploaded_images/noimage.jpg";
        $product->user_id = auth()->user()->id;
        $product->save();

        // foreach($product->photos as $photo){
        //     Storage::delete('/public/'.$photo->path);
        // }
        $product->photos()->delete();
            
        if(count($productPhotos)>0){
            foreach($productPhotos as $p){
                $product_photo = new ProductPhoto();
                $product_photo->path = $p;
                $product_photo->product_id = $product->id;
                $product_photo->save();    
            }
        }
        return redirect('/dashboard')->with('success','New Product Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(auth()->user()->id!=$product->user_id){
            return redirect('/')->with('error','Unauthorized');
        }
        // if($product->cover_image!='noimage.jpg'){
        //     //Delete Image
        //     Storage::delete('public/uploaded_images/'.$product->cover_image);
        // }
        foreach($product->photos as $photo){
            Storage::delete('/public/'.$photo->path);
        }
        // $product->photos()->delete();
        $product->delete();
        return back()->with('success','Post Removed');
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    
        $items = $items instanceof Collection ? $items : Collection::make($items);
    
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
