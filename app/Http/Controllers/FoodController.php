<?php

namespace App\Http\Controllers;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller {

    public function index() {
        $data = Food::get();
        return response()->json($data);
    }


    public function store(Request $request) {
        Food::insert([
            "name"    => $request->name,
            "price"   => $request->price,
        ]);
    }

    

    public function update(Request $request) {
      Food::where("id", $request->id)->update([
          "name"    => $request->name,
          "price"   => $request->price,
      ]);
    }

}
