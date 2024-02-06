<?php

namespace App\Http\Controllers\Orders;
use App\Models\Orders\Orders;
use App\Models\PlanFoods;
use App\Models\City;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Orders\DeliveryCases;
use Illuminate\Http\Request;

class OrdersController extends Controller {

    public function index(Request $request, $acount, $id) {
      $city = City::get();
      $delivery = User::where("acount", "delivery")->get();
      $clints = User::where("acount", "clint")->get();
      $plan_foods = PlanFoods::get();
      $delivery_cases = DeliveryCases::get();
      $data = Orders::query();

        $data//->join("users", "users.id", "=", "order.clint")
//->join("subscriptions", "subscriptions.id", "=", "order.subscription")
        ->join("delivery_cases", "delivery_cases.id", "=", "order.delivery_cases")
        ->join("subscriptions", "subscriptions.id", "=", "order.subscription")
        ->select( "subscriptions.username", 
                  "subscriptions.address", 
                  "subscriptions.phone", 
                  //"subscriptions.lunch", 
                  //"subscriptions.dinner", 
                  "delivery_cases.name as cases_name", 
                  //"users.phone", 
                  //"users.name as clint_delivery", 
                  "order.*");
        
        //If thare is Start > Get Data with $request->start
        if($request->start) :
            $data->where("order.date", ">=", $request->start);
            $test = $request->start;
        endif;
        //If thare is End > Get Data with $request->end
        if($request->end) :
            $data->where("order.date", "<=", $request->end);
        endif;
        //If thare is isset status > Get Data with $request->status
        if($request->status > 0) :
            $data->where("order.delivery_cases", $request->status);
        endif;
        //If thare is isset status > Get Data with $request->status
        if($request->city > 0) :
            $data->where("users.city", $request->city);
        endif;

        if($request->delivery > 0) :
            $data->where("order.delivery", $request->delivery);
        endif;
        if($request->clint > 0) :
            $data->where("order.clint", $request->clint);
        endif;

        if($request->orderBy > 0) :
            $data->orderBy("id", $request->orderBy);
        else :
          $data->orderBy("id", "DESC");
        endif;

        $search = '%' . request('search') . '%';

        if($request->search) :
          $data->where('users.name', 'like', $search)
                ->orWhere('users.phone', 'like', $search)
                ->orWhere('users.phone', 'like', $search)
                ->orWhere('users.city', 'like', $search)
                ->orWhere('users.address', 'like', $search);
        endif;
        

        if($acount == "clint") :
            $data->where("order.clint", $id);
        endif;

        if($acount == "delivery") :
            $data->where("order.delivery", $id);
        endif;

        $orders = $data->get();

        $totalOrder = 0;
        foreach($orders as $item) :
          $totalOrder += $item->delivery_price;
        endforeach;
        $totalOrder;
 

        return response()->json([
          "city"   => $city,
          "orders" => $orders,
          "delivery" => $delivery,
          "clints" => $clints,
          "plan_foods" => $plan_foods,
          "delivery_cases" => $delivery_cases,
          "totalOrder" => $totalOrder
        ]);
    }



    public function store(Request $request) {
      $subscription = Subscription::where("id", $request->id)->first();
      Subscription::where("id", $request->id)->update([
        "status_done"      => true,
      ]);
      Orders::insert([
          "clint"      => $subscription->clint,
          "subscription" => $request->id,
          "delivery_cases" => 1,
          'time_last_update' => date("F j, Y, g:i a"),
          'date'     => date("Y-n-j"),
          'time'     => date("F j, Y, g:i a"),
        ]);
        
    }

    public function update(Request $request) {
      Plans::where("id", $request->id)->update([
          "name"    => $request->name,
          "price"   => $request->price,
      ]);
    }

}
