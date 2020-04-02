<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\View;
use App\User;
use App\Product;
use App\Post;
use App\Fingerprint;
use DB;
class ViewsController extends Controller
{
    public function store(Request $request){
        $response = array('status'=>'OK');
        try{
            $view = new View();
            //save or update browser fingerprint in fingerprints table
            $fingerprint = Fingerprint::where('hash','=',$request->fingerprint)->first();
            if($fingerprint==null){
                //create new fingerprint
                $new_fingerprint = new Fingerprint();
                $new_fingerprint->hash = $request->fingerprint;
                $new_fingerprint->browser_metadata = json_encode($request->metadata);
                if(auth()->check()){
                    $new_fingerprint->user_id = auth()->user()->id;
                }else{
                    $new_fingerprint->user_id = 0;
                }
                $new_fingerprint->save();
            }

            if($fingerprint->user_id==0){
                if(auth()->check()){
                    $fingerprint->user_id = auth()->user()->id;
                    $fingerprint->save();
                }
            }
            $view->fingerprint_id = $fingerprint->id;
            $view->object_type = $request->object_type;
            $view->object_id = $request->object_id;
            $view->url = $request->url;
            $view->save();    
        }catch(\Exception $e){
            $response['status'] = $e->getMessage();
        }
        return response()->json($response);
    }
    public function getViews($object_type,$object_id){
        $views = View::where('object_type','=',$object_type)->where('object_id','=',$object_id)->get();
        return $views;
    }
    public function show(Request $request){
        try{
            $fingerprints = DB::select('SELECT * FROM fingerprints, (SELECT fingerprint_id, COUNT(*) AS views_count FROM views WHERE object_type=:object_type and object_id=:object_id GROUP BY fingerprint_id) AS temp WHERE fingerprints.id=temp.fingerprint_id',array('object_type'=>$request->object_type,'object_id'=>$request->object_id));
            $data = (object)(array());
            $data->total_views = 0;
            foreach($fingerprints as $fingerprint){
                $user_name = "No name";
                if($fingerprint->user_id!=0){
                    $user = User::find($fingerprint->user_id);
                    $user_name = $user->name;
                }
                $browserMetadata = json_decode($fingerprint->browser_metadata);
                $fingerprint->user_name = $user_name;
                $fingerprint->browser = $browserMetadata[0]->value;
                $data->total_views+=$fingerprint->views_count;
            }

            if($request->object_type=="product"){
                $data->title = Product::find($request->object_id)->name;
            }else if($request->object_type=="post"){
                $data->title = Post::find($request->object_id)->title;
            }else{
                $data->title = $request->object_type." ".$request->object_id;
            }

            return view('views.show')->with(['fingerprints'=>$fingerprints,'data'=>$data]);
        }catch(\Exception $e){
            return response()->json(array('status'=>$e->getMessage()));
        }

    }
}
