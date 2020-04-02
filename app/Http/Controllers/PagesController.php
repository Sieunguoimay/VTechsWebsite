<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Product;
use App\View;
use App\Order;
class PagesController extends Controller
{
    // private $viewsController;
    private $ordersController;
    public function __construct()
    {
        // $this->viewsController = new ViewsController();
        $this->ordersController = new OrdersController();
    }
    public function index(){
        // $this->viewsController->store_view('home',0,request()->path());

        $title = 'Welcome to VTECHS';
        $slides=['a.jpg','slide2.jpg','fixed_background.jpg'];//load this images from database
        $images = [
            'whyChooseUs'=>'rooftop-solar-panels.jpg',
            'ourPhilosophy'=>'rooftop-solar-panels_2.jpg',
            'fixedBackground'=>'solar-panel-closeup_2.jpg'];

        $posts = Post::where('category','=','solution')->orwhere('category','=','')->orderBy('created_at','desc')->take(5)->get();

        $news = Post::where('category','=','news')->orderBy('created_at','desc')->take(4)->get();
        $products = Product::orderBy('created_at','desc')->take(5)->get();

        return view('pages.index')->with([
            'title'=>$title,
            'slides'=>$slides,
            'images'=>$images,
            'posts'=>$posts,
            'news'=>$news,
            'products'=>$products,
            'capacity_form'=>$this->ordersController->getCapacityForm()
            ]);
    }
    public function about(){
        // $this->viewsController->store_view('about',0,request()->path());
        return view('pages.about');
    }
    public function contact(){
        // $this->viewsController->store_view('contact',0,request()->path());
        return view('pages.contact');
    }


}


    // public function products(){
    //     $product = [
    //         'name'=>'Product A',
    //         'description'=>'this is a description',
    //         'price'=>10000,
    //         'images'=>['noimage.jpg','noimage.jpg','noimage.jpg']
    //     ];
    //     $products = [];
    //     for($i = 0; $i<10;$i++){
    //         array_push($products,$product);
    //     }
    //     return view('pages.products');
    // }