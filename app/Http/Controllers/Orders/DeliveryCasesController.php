<?php

namespace App\Http\Controllers\Orders;
use App\Models\Orders\DeliveryCases;

use Illuminate\Http\Request;

class DeliveryCasesController extends Controller {


    public function index() {
      $data = DeliveryCases::get();
      return response()->json($data);

    }


    public function store(Request $request) {
        DeliveryCases::insert([
          "name"    => $request->name,
          "color"   => $request->color,
        ]);

    }

    public function update(Request $request) {
      DeliveryCases::where("id", $request->id)->update([
        "name"    => $request->name,
        "color"   => $request->color,
      ]);
    }

}
