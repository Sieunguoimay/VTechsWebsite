<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\View;
use DB;
class PostsController extends Controller
{
    private $viewsController;
    private $categories = array('writing','news','solution');
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show','news','solutions','writings']]);
        $this->viewsController = new ViewsController();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = DB::select('SELECT*FROM posts');
        // $posts = Post::all();
        // $posts = Post::orderBy('title','desc')->take(1)->get();

        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts',$posts);
    }
    public function writings()
    {
        $posts = Post::where('category','=','writing')->orwhere('category','=','')
        ->orderBy('created_at','desc')->paginate(12);
        return view('posts.index')->with(['posts'=>$posts,'title'=>'Bài viết']);
    }
    public function news()
    {
        $posts = Post::where('category','=','news')->orderBy('created_at','desc')->paginate(12);
        return view('posts.index')->with(['posts'=>$posts,'title'=>'Tin tức']);
    }
    public function solutions()
    {
        $posts = Post::where('category','=','solution')->orderBy('created_at','desc')->paginate(12);
        return view('posts.index')->with(['posts'=>$posts,'title'=>'Giải pháp']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',$this->categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:10240'
        ]);

        //Handle file upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            
            if(!Storage::disk('local')->exists($filenameWithExt)){
    
                //Get just filename
                $filename = pathInfo($filenameWithExt,PATHINFO_FILENAME);
                //GetJust extension
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                //Upload Image
                $path = $request->file('cover_image')->storeAs('public/uploaded_images',$fileNameToStore);
            }

        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        //create post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = '/uploaded_images/'.$fileNameToStore;
        $post->category = $request->category;
        $post->save();
        return redirect('/dashboard')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $views = $this->viewsController->getViews('post',$id);
        $post = Post::find($id);
        $post->views = $views;
        $posts = Post::where('category','=',$post->category)->orderBy(DB::raw('RAND()'))->take(3)->get();
        return view('posts.show')->with(['post'=>$post,'posts'=>$posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id!=$post->user_id){
            return back()->with('error','Unauthorized ');
        }
        return view('posts.edit')->with(['post'=>$post,'categories'=>$this->categories]);
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

        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);

        //Handle file upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            if(!Storage::disk('local')->exists($filenameWithExt)){
                //Get just filename
                $filename = pathInfo($filenameWithExt,PATHINFO_FILENAME);
                //GetJust extension
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                //Upload Image
                $path = $request->file('cover_image')->storeAs('public/uploaded_images',$fileNameToStore);
            }

        }


        //create post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category = $request->category;
        
        if($request->hasFile('cover_image')){
            $post->cover_image = '/uploaded_images/'.$fileNameToStore;
        }
        $post->save();

        // return redirect('/posts')->with('success','Post Updated');

        $posts = Post::orderBy(DB::raw('RAND()'))->take(3)->get();
        $post = Post::find($id);
        $views = $this->viewsController->getViews('post',$id);
        $post->views = $views;
        return view('posts.show')->with(['post'=>$post,'posts'=>$posts,'success'=>'Post Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id!=$post->user_id){
            return redirect('/posts')->with('error','Unauthorized');
        }
        if($post->cover_image!='noimage.jpg'){
            //Delete Image
            Storage::delete('public/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/dashboard')->with('success','Post Removed');
    }
}
