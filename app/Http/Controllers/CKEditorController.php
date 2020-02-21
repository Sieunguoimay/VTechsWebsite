<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CKEditorController extends Controller
{

    public function image_upload(Request $request){
        //Get filename with the extension
        $filenameWithExt = $request->file('upload')->getClientOriginalName();
        //Get just filename
        $filename = pathInfo($filenameWithExt,PATHINFO_FILENAME);
        //GetJust extension
        $extension = $request->file('upload')->getClientOriginalExtension();
        //Filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //Upload Image
        $path = $request->file('upload')->storeAs('/public/cover_images',$fileNameToStore);

        return "<p>Uploaded ".$filenameWithExt."</p>";
    }

    public function image_browse(){
        $paths = glob(public_path('/storage/cover_images/*'));
        $images = array();
        foreach($paths as $path){
            array_push($images,['name'=>basename($path),'original_name'=>'No name','size'=>getimagesize($path)]);
        }
        return view('layouts.file_browse')->with('images',$images);
    }
}
