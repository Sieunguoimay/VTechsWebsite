<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
class CategoriesController extends Controller
{
    public function index($currentId=-1){
        $categories = Category::all();
        foreach($categories as $category){
            $count = count($category->products);
            $category->name.=" (".$count.")";
            $category->selected = $category->id == $currentId;
        }
        return view('products.category')->with('categories',$categories);
    }
    public function edit(){
        $categories = Category::all();
        foreach($categories as $category){
            $category->count = count($category->products);
        }
        return view('products.category_edit')->with('categories',$categories);
    }
    public function update(Request $request, $id){
        $response = array("status"=>"OK");
        try{
            $category = Category::find($id);
            $category->name = $request->new_category;
            $category->save();    
        }catch(\Exception $e){
            $response["status"] = $e->getMessage();
        }
        return response()->json($response);        
    }
    public function destroy($id){
        $response = array("status"=>"OK");
        try{
            $category = Category::find($id);
            $category->delete();    
        }catch(\Exception $e){
            $response["status"] = $e->getMessage();
        }
        return response()->json($response);        
    }
    public function store(Request $request){
        $newCategory = $request->new_category;
        $response = array("new_category"=>$newCategory);
        $status = Category::where('name','=',$newCategory)->first();
        if($status === null){
            try{
                $category = new Category();
                $category->name = $newCategory;
                $category->save();    
                $response["new_category_id"]=DB::getPdo()->lastInsertId();
                $response["status"]="OK";
            }catch(\Exception $e){
                $response["status"]=$e->getMessage();
            }
        }else{
            $response["status"]="Existed";
        }
        return response()->json($response);
    }

    public function select($currentId=0){
        if($currentId==null) $currentId = 0;
        $categories = Category::all();
        foreach($categories as $category){
            $count = count($category->products);
            $category->name.=" (".$count.")";
            $category->isSelected = ($category->id == $currentId);
        }
        return view('products.category_select')->with('categories',$categories);
    }
}
