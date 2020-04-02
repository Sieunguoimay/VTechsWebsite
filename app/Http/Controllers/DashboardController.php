<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\View;

use App\Category;
class DashboardController extends Controller
{
    private $viewsController;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->viewsController = new ViewsController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();//User::find($user_id);
        if($user->is_admin){
            $posts = $user->posts;
            foreach($posts as $post){
                $post->views = $this->viewsController->getViews('post',$post->id);
                $post->views_count = count($post->views);
            }
            $products = $user->products;
            foreach($products as $product){
                $product->views = $this->viewsController->getViews('product',$product->id);
                $product->views_count = count($product->views);
                if($product->category==null){
                    $product->category = new Category();
                    $product->category->id = 0;
                    $product->category->name = 'Not specified';
                }
            }
            $users = User::all();
            return view('dashboard')->with([
                'posts'=>$posts,
                'products'=>$products,
                'users'=>$users
            ]);
        }else{
            return view('users.profile');
        }

    }
    public function delete_user($id){
        $user = User::find($id);    
        $userName = $user->name;
        $user->delete();
        return back()->with('message','Deleted user $userName');
    }
    public function make_admin($id){
        try{
            $user = User::find($id);    
            $userName = $user->name;
            if($user->is_admin){
                return response()->json(['status'=>'NotOK','message'=>'$user->name is already admin']);
            }else{
                $user->is_admin = true;
                return response()->json(['status'=>'OK']);
            }
        }catch(\Exception $e){
            return response()->json(['status'=>$e->getMessage()]);
        }
    }
}
