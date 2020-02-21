<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductPhoto;
use Validator;
use DB; 
class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->paginate(10);
        return view('products.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hasProductPhoto = $request->has('product_photo');
        $productPhoto = "noimage.jpg";
        if($hasProductPhoto){
            $productPhoto = $request->input('product_photo');
        }


        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->list_price = $request->input('price');
        $product->category_id = 0;
        $product->quantity = $request->input('quantity');
        $product->cover_image = $productPhoto;
        $product->user_id = auth()->user()->id;
        $product->save();

            
        if($hasProductPhoto){
            $product_photo = new ProductPhoto();
            $product_photo->path = $productPhoto;
            $product_photo->product_id = $product->id;
            $product_photo->save();
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
        $validation = Validator::make($request->all(),['select_file'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048']);
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
            $path = $request->file('select_file')->storeAs('public/cover_images',$fileNameToStore);



            return response()->json([
                'message'=>'Image Uploaded Successfully',
                'uploaded_image_html'=>'<img src="/storage/cover_images/'.$fileNameToStore.'" class="img-thumbnail rounded-circle" width="300"/>',
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
