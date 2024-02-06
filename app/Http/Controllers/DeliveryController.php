<?php

namespace App\Http\Controllers;
use App\Models\Food;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends Controller {


  public function index($type) {
    $data = User::where("acount", $type)->get();
    return response()->json($data);
  }


}
