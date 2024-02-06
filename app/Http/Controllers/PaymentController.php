<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Plans;
use App\Models\Banks;
use App\Models\User;
use App\Models\City;
use App\Models\Meals;

class PaymentController extends Controller {


    public function index(Request $request) {
      $plans = Plans::get();
      $banks = Banks::get();
      $clints = User::where("acount", "clint")->get();

      $city = City::get();
      $meals = Meals::get();


      $test = "";
      // Payment Query
      $data = Payment::query();
      // Join Table => banks, payment, users, plans
      $data
                        ->join("plans", "plans.id", "=", "payment.plan")
                        ->join("meals", "meals.id", "=", "payment.meals_count")
                        ->select(
                                  "meals.name as meals_name",
                                  "plans.name as plan_name",
                                  "payment.*");
      //If thare is Start > Get Data with $request->start
      if($request->start) :
          $data->where("payment.date", ">=", $request->start);
          $test = $request->start;
      endif;
      //If thare is End > Get Data with $request->end
      if($request->end) :
          $data->where("payment.date", "<=", $request->end);
      endif;
      //If thare is isset clint > Get Data with $request->clint
      if($request->clint > 0) :
          $data->where("payment.clint", $request->clint);
      endif;
      //If thare is isset bank > Get Data with $request->bank
      if($request->bank > 0) :
          $data->where("payment.bank", $request->bank);
      endif;
      // If thare is isset plan > Get Data with $request->plan
      if($request->plan > 0) :
          $data->where("payment.plan", $request->plan);
      endif;
      if($request->city > 0) :
          $data->where("users.city", $request->city);
      endif;
      if($request->search) :
        $data->where('users.name', 'like', '%' . request('search') . '%');
        $data->where('users.phone', 'like', '%' . request('phone') . '%');
      endif;

      // Get Data
      $payment = $data->get();
      // Return Data
      return response()->json([
        "plans"   => $plans,
        "banks"   => $banks,
        "clints"  => $clints,
        "payment" => $payment,
        "city"    => $city,
        "meals"   => $meals,
        "test"    => $test
      ]);
    }


    public function store(Request $request) {
        Payment::insert([
          "clint"    => $request->clint,
          "muazaf"   => $request->muazaf,
          "plan"     => $request->plan,
          "bank"     => $request->bank,
          "money"    => $request->money,
          "discount" => $request->discount,
          "note"     => $request->note,
          'days'     => $request->days,
          'meals_count' => $request->meals_count,
          'receiving_method' => $request->receiving_method,

          'date'     => $request->date,
          'time'     => date("F j, Y, g:i a"),
        ]);
        return response()->json([
          "statusCode" => 1,
          "status" => 'success'
        ]);
    }

    public function update(Request $request) {
      Payment::where("id", $request->id)->update([
        "clint"    => $request->clint,
        //"muazaf"   => $request->muazaf,
        "plan"     => $request->plan,
        "bank"     => $request->bank,
        "money"    => $request->money,
        "discount" => $request->discount,
        "note"     => $request->note,
        'time'     => date("F-j-Y"),
        'date'     => $request->date,
        'days'     => $request->days,
        'meals_count' => $request->meals_count,
        'receiving_method' => $request->receiving_method,
      ]);
      return response()->json([
        "statusCode" => 1,
        "status" => 'success'
      ]);

    }

}
