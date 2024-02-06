<?php

namespace App\Http\Controllers;
use App\Models\Food;
use App\Models\Plans;
use App\Models\City;
use App\Models\PlanFoods;
use App\Models\CategoryPlans;
use Illuminate\Http\Request;
// https://www.ixxx.com/pornstar/angela-white
// https://www.ixxx.com/c/lesbian
// https://www.momvids.com/videos/86594/lesbian-sex-stepmom-lk-stepmom-lust/?utm_source=PBWeb&utm_medium=PBWeb&sub=100001&asgtbndr=1
// https://www.youtube.com/shorts/Zb_0FBwYukA
class PlansController extends Controller {

    public function index($id) {

        $plans = Plans::join("category_plan", "category_plan.id", "=", "plans.category")
                      ->select("plans.*", "category_plan.name as category_plan_name")
                      ->where('category', $id)
                      ->get();
        $foods = Food::get();
        $city  = City::get();
        $categories = CategoryPlans::get();
        $planFood = planFoods::join("food", "food.id", "=", "plan_foods.item")->get();

        return response()->json([
          "plans" => $plans,
          "foods" => $foods,
          "city"  => $city,
          "planFood" => $planFood,
          "categories" => $categories
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
      Plans::insert([
          "name"          => $request->name,
          "price"         => $request->price,
          "description"   => $request->description,
          "category"      => $request->category,
          "picture"       => $fileName,
      ]);
      /*
      $pizza  = $request->arrayFood;
      $pieces = explode(",", $pizza);
      $plan = Plans::orderBy("id", "DESC")->first();
      for($i = 0; $i < count($pieces); $i++) {
        PlanFoods::insert([
          "plan"    => $plan->id,
          "item"    => $pieces[$i],
        ]);
      }
      */
        
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
          "name"         => $request->name,
          "price"        => $request->price,
          "description"  => $request->description,
          "category"     => $request->category,
          "picture" => $fileName,
      ]);

      if($request->arrayFood) {
        $pizza  = $request->arrayFood;
        $pieces = explode(",", $pizza);
        $plan = Plans::orderBy("id", "DESC")->first();
        for($i = 0; $i < count($pieces); $i++) {
          PlanFoods::insert([
            "plan"    => $plan->id,
            "item"    => $pieces[$i],
          ]);
        }
      }  // arrayFood

      
    } // Update

}
