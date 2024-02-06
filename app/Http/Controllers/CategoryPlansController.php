<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Plans;
use App\Models\CategoryPlans;
use App\Models\PlanFoods;

class CategoryPlansController extends Controller {

    public function index() {
        $plans = CategoryPlans::get();
        return response()->json([
          "plans" => $plans,
        ]);
    }


    public function store(Request $request) {
      if($request->hasFile("picture")) :
        $fileExtintion = $request->picture->getclientoriginalextension();
        $fileName = time() . "." . $fileExtintion;
        $path = "G:\Vue Js\\restaurant\public\img\plans";
        $request->picture->move($path, $fileName);
      else :
        $fileName = '';
      endif;
      CategoryPlans::insert([
          "name"    => $request->name,
          "picture" => $fileName
      ]);
    }

    public function update(Request $request) {
      $plan = Plans::where("id", $request->id)->first();
      if($request->hasFile("picture")) :
        $fileExtintion = $request->picture->getclientoriginalextension();
        $fileName = time() . "." . $fileExtintion;
        $path = "G:\Vue Js\\restaurant\public\img\plans";
        $request->picture->move($path, $fileName);
      else :
        $fileName = $plan->picture;
      endif;
      Plans::where("id", $request->id)->update([
          "name"    => $request->name,
          "picture" => $fileName
      ]);
      echo $request->id;
    } // Update

}
