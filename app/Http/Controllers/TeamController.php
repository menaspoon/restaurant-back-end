<?php

namespace App\Http\Controllers;
use App\Models\Team;

use Illuminate\Http\Request;

class TeamController extends Controller {

    public function index() {
        $data = Team::get();
        return response()->json($data);
    }


    public function store(Request $request) {

      if($request->hasFile("picture")) :
        $fileExtintion = $request->picture->getclientoriginalextension();
        $fileName = time() . "." . $fileExtintion;
        $path = "G:\Vue Js\\restaurant\public\img\plans";

        $request->picture->move($path, $fileName);
      else :
        $fileName = null;
      endif;
      
      Team::insert([
          "name"   => $request->name,
          "work"   => $request->work,
          "description"  => $request->description,
          "picture" => $fileName,
      ]);

      return response()->json([
        "statusCode" => $request->arrayFood,
      ]);
        
    }

    public function update(Request $request) {

      $item = Team::where("id", $request->id)->first();
      
      if($request->hasFile("picture")) :
        $fileExtintion = $request->picture->getclientoriginalextension();
        $fileName = time() . "." . $fileExtintion;
        $path = "G:\Vue Js\\restaurant\public\img\plans";
        $request->picture->move($path, $fileName);
      else :
        $fileName = $item->picture;
      endif;
      
      Team::where("id", $request->id)->update([
          "name"   => $request->name,
          "work"   => $request->work,
          "description"  => $request->description,
          "picture" => $fileName,
      ]);
      
    } // Function Update

}
