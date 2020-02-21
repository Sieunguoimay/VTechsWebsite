<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Product;

class PagesController extends Controller
{
    private $socialMedia = [
        'facebook'=>'https://www.facebook.com',
        'twitter'=>'https://www.twitter.com',
        'google'=>'https://www.google.com',
        'instagram'=>'https://www.instagram.com',
        'youtube'=>'https://www.youtube.com'
    ];
    public function index(){
        $title = 'Welcome to VTECHS';
        $slides=['slide1.jpg','slide2.jpg','slide3.jpg'];//load this images from database
        $images = ['whyChooseUs'=>'rooftop-solar-panels.jpg','ourPhilosophy'=>'fixed_background.jpg','fixedBackground'=>'solar-panel-closeup.jpg'];


        $posts = Post::orderBy('created_at','desc')->paginate(10);
        $products = Product::orderBy('created_at','desc')->take(5)->get();

        return view('pages.index')->with([
            'title'=>$title,
            'slides'=>$slides,
            'images'=>$images,
            'socialMedia'=>$this->socialMedia,
            'posts'=>$posts,
            'products'=>$products
            ]);
    }
    public function about(){
        return view('pages.about');
    }
    public function contact(){
        return view('pages.contact')->with('socialMedia',$this->socialMedia);
    }
    public function products(){
        $product = [
            'name'=>'Product A',
            'description'=>'this is a description',
            'price'=>10000,
            'images'=>['noimage.jpg','noimage.jpg','noimage.jpg']
        ];
        $products = [];
        for($i = 0; $i<10;$i++){
            array_push($products,$product);
        }
        return view('pages.products')->with('products',$products);
    }
}
