<?php

namespace App\Http\Controllers;
use App\Models\Plans;
use App\Models\Banks;
use App\Models\User;
use App\Models\City;
use App\Models\DailyInvoices;

use Illuminate\Http\Request;

class DailyInvoicesController extends Controller {


    public function index(Request $request) {
      $plans = Plans::get();
      $banks = Banks::get();
      $clints = User::where("acount", "clint")->get();
      $city = City::get();

      // subscriptions Query
      $data = DailyInvoices::query();
      $data
            //->join("banks", "banks.id", "=", "daily_invoices.bank")
           ->join("city", "city.id", "=", "daily_invoices.city")
           ->select("city.name as city_name",  "daily_invoices.*");

      //If thare is Start > Get Data with $request->start
      if($request->start) :
          $data->where("daily_invoices.date", ">=", $request->start);
      endif;
      //If thare is End > Get Data with $request->end
      if($request->end) :
          $data->where("daily_invoices.date", "<=", $request->end);
      endif;
      //If thare is isset bank > Get Data with $request->bank
      if($request->bank > 0) :
          $data->where("daily_invoices.bank", $request->bank);
      endif;
      if($request->city > 0) :
          $data->where("city", $request->city);
      endif;
      if($request->search) :
        $data->where('daily_invoices.clint', 'like', '%' . request('search') . '%');
      endif;

      // Get Data
      $subscription = $data->get();
      // Return Data
      return response()->json([
        "plans"   => $plans,
        "banks"   => $banks,
        "clints"  => $clints,
        "subscription"  => $subscription,
        "city"    => $city,
      ]);

    }


    public function store(Request $request) {
        DailyInvoices::insert([
          "clint"    => $request->clint,
          //"muazaf"   => $request->muazaf,
          "money"    => $request->money,
          "bank"     => $request->bank,
          "city"     => $request->city,
          "order"    => $request->order,
          "note"     => $request->note,
          'date'     => date("Y-n-j"),
          'time'     => date("F j, Y, g:i a"),
        ]);
        return response()->json([
          "statusCode" => 1,
          "status" => 'success'
        ]);
    }

    public function update(Request $request) {
      DailyInvoices::where("id", $request->id)->update([
        "clint"    => $request->clint,
        //"muazaf"   => $request->muazaf,
        "money"    => $request->money,
        "bank"     => $request->bank,
        "city"     => $request->city,
        "order"    => $request->order,
        "note"     => $request->note,
        'time'     => date("F-j-Y"),
        'date'     => date("F j, Y, g:i a"),
      ]);
      return response()->json([
        "statusCode" => 1,
        "status" => 'success'
      ]);

    }

}
