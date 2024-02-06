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

class UserController extends Controller {



    public function login(Request $request) {
      $credentials = $request->validate([
        'email' => ['required'],
        'password' => ['required'],
      ]);

      if (Auth::attempt($credentials)) {
        return response()->json([
          "status" => true,
          "message" => "Success",
          "auth" => Auth::id()
        ]);
      } else {
        return response()->json([
          "status" => false,
          "message" => "faild"
        ]);
      }
    }



}
