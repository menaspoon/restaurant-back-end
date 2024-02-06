<?php

namespace App\Http\Controllers;
use App\Models\Service;

use Illuminate\Http\Request;

class ServicesController extends Controller {


    public function index() {
      // Get Data
      $data = Service::get();
      // Return Data
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
      Service::insert([
        "name"    => $request->name,
        "description"     => $request->description,
        "picture"     => $fileName,
      ]);

    }

    public function update(Request $request) {
      $item = Service::where("id", $request->id)->first();
      if($request->hasFile("picture")) :
        $fileExtintion = $request->picture->getclientoriginalextension();
        $fileName = time() . "." . $fileExtintion;
        $path = "G:\Vue Js\\restaurant\public\img\plans";
        $request->picture->move($path, $fileName);
      else :
        $fileName = $item->picture;
      endif;

      Service::where("id", $request->id)->update([
        "name"    => $request->name,
        "description"     => $request->description,
        "picture"     => $fileName,
      ]);


    }

}
