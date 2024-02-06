<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ToDayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\DailyInvoicesController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\CategoryPlansController;

// Orders
use App\Http\Controllers\Orders\DeliveryCasesController;
use App\Http\Controllers\Orders\OrdersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('public', [PublicController::class, 'index']);
Route::get('public.category/{category}', [PublicController::class, 'category']);
Route::post('destroy', [PublicController::class, 'destroy']);
Route::post('update.status', [PublicController::class, 'update_status']);

// Foods Controller
Route::get('food', [FoodController::class, 'index']);
Route::post('store.food', [FoodController::class, 'store']);
Route::post('update.food', [FoodController::class, 'update']);
// Member Controller
Route::get('member/{type}', [MemberController::class, 'index']);
Route::post('store.acount', [MemberController::class, 'store']);
Route::post('update.acount', [MemberController::class, 'update']);
Route::post('update.my.acount', [MemberController::class, 'update_my_acount']);
Route::post('signup', [MemberController::class, 'signup']);
Route::post('log.in', [MemberController::class, 'login']);
Route::get('profile/{id}', [MemberController::class, 'profile']);
// Plans Controller
Route::get('plans/{id}', [PlansController::class, 'index']);
Route::post('store.plan', [PlansController::class, 'store']);
Route::post('update.plan', [PlansController::class, 'update']);
// Service Controller
Route::get('services', [ServicesController::class, 'index']);
Route::post('store.services', [ServicesController::class, 'store']);
Route::post('update.service', [ServicesController::class, 'update']);

Route::get('payment', [PaymentController::class, 'index']);
Route::get('payment/{bank}/{clint}', [PaymentController::class, 'index']);
Route::post('store.payment', [PaymentController::class, 'store']);
Route::post('update.payment', [PaymentController::class, 'update']);



Route::get('subscription', [SubscriptionController::class, 'index']);
Route::post('store.subscription', [SubscriptionController::class, 'store']);
Route::post('update.subscription', [SubscriptionController::class, 'update']);


Route::get('to.day', [ToDayController::class, 'index']);
Route::post('update.status.subscription.today', [ToDayController::class, 'update_status']);



Route::get('test', [HomeController::class, 'test']);
Route::get('dashbord', [HomeController::class, 'index']);




Route::get('daily.invoices', [DailyInvoicesController::class, 'index']);
Route::post('store.daily.invoices', [DailyInvoicesController::class, 'store']);
Route::post('update.daily.invoices', [DailyInvoicesController::class, 'update']);



Route::get('contact', [ContactController::class, 'index']);
Route::post('store.contact', [ContactController::class, 'store']);





Route::get('notifications/{user}', [NotificationsController::class, 'index']);



Route::get('orders/{acount}/{id}', [OrdersController::class, 'index']);
Route::post('create.order', [OrdersController::class, 'store']);


Route::get('delivery.cases', [DeliveryCasesController::class, 'index']);
Route::post('store.delivery.cases', [DeliveryCasesController::class, 'store']);
Route::post('update.delivery.cases', [DeliveryCasesController::class, 'update']);


Route::get('teams', [TeamController::class, 'index']);
Route::post('store.team', [TeamController::class, 'store']);
Route::post('update.team', [TeamController::class, 'update']);

//Route::post('login', [UserController::class, 'login']);



Route::get('category.plans', [CategoryPlansController::class, 'index']);
Route::post('store.category.plan', [CategoryPlansController::class, 'store']);
Route::post('update.category.plan', [CategoryPlansController::class, 'update']);









Route::post('login', 'App\Http\Controllers\PassportController@login');
Route::post('register', 'App\Http\Controllers\PassportController@register');

Route::middleware('auth:api')->group(function () {
    Route::get('user', 'App\Http\Controllers\PassportController@details');

    Route::resource('products', 'ProductController');
});