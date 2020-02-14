<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to VTECHS';
        return view('pages.index')->with('title',$title);
    }
    public function about(){
        $title = 'About Us';
        return view('pages.about')->with('title',$title);
    }
    public function products(){
        return view('pages.products')->with([
            'title' => 'Products',
            'products'=> ['Service1','Service2']
            ]);
    }
}
