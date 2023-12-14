<?php
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\BillController;
use App\Http\Controllers\admin\StripeController;
use App\Http\Controllers\admin\EquipmentController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\LocationController;
use App\Http\Controllers\admin\LotelController;
use App\Http\Controllers\admin\RoomController;
use App\Http\Controllers\admin\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\users\UserController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\HandbookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\HistoryController;
use App\Http\Controllers\admin\StatisController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['admin'])->group(function (){
    Route::get('/admin/main',[StatisController::class,'statis'])->name('admin.statis');
});

Route::middleware(['user'])->group(function (){
    Route::get('/home',[HomeController::class,'home'])->name('home');
});



Route::get('/admin/statis/hotel',[StatisController::class,'adminSearchHotel'])->name('admin.hotel.search');
Route::get('/admin/statis/motel',[StatisController::class,'adminSearchMotel'])->name('admin.motel.search');
Route::get('/admin/statis/homestay',[StatisController::class,'adminSearchHomestay'])->name('admin.homestay.search');
Route::get('/admin/statis/room/{id}',[StatisController::class,'roomStatis'])->name('roomStatis');
Route::get('/admin/statis/hotel/room/{id}',[StatisController::class,'adminSearchHotelRoom'])->name('admin.hotel.room');
Route::get('/admin/statis/motel/room/{id}',[StatisController::class,'adminSearchMotelRoom'])->name('admin.motel.room');
Route::get('/admin/statis/homestay/room/{id}',[StatisController::class,'adminSearchHomestayRoom'])->name('admin.homestay.room');


Route::get('/home',[HomeController::class,'home'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/fillter', [HomeController::class, 'fillter'])->name('fillter');





Route::get('/logoutadmin',[UserController::class,'logoutAdmin'])->name('logoutAdmin');

Route::get('/admin/users/register',[UserController::class,'showRegisterAdmin'])->name('showRegisterAdmin');
Route::post('/admin/users/register',[UserController::class,'postRegisterAdmin'])->name('postRegisterAdmin');

Route::get('/admin/users/login',[UserController::class,'showLoginAdmin'])->name('showLoginAdmin');
Route::post('/admin/users/login',[UserController::class,'postLoginAdmin'])->name('postLoginAdmin');

Route::get('/register',[AuthController::class,'showFormRegister'])->name('showRegister');
Route::post('/register',[AuthController::class,'postRegister'])->name('postRegister');

Route::get('/login',[AuthController::class,'showFormLogin'])->name('show-form-login');
Route::post('/login',[AuthController::class,'postLogin'])->name('postLogin');

Route::get('/logout',[AuthController::class,'logout'])->name('logout');


Route::get('/admin/users',[UserController::class,'users'])->name('admin.users');
Route::get('/admin/users/index',[UserController::class,'usersIndex'])->name('users.index');
Route::get('/admin/users/{id}',[UserController::class,'usersDestroy'])->name('users.destroy');
Route::get('/admin/users/edit/{id}',[UserController::class,'usersEdit'])->name('users.edit');
Route::post('/admin/users/store/{id}',[UserController::class,'usersUpdate'])->name('users.update');

Route::get('/admin/category',[AdminController::class,'category'])->name('admin.category');
Route::get('/admin/category/create',[CategoryController::class,'categoryCreate'])->name('category.create');
Route::post('/admin/category/create',[CategoryController::class,'categoryStore'])->name('category.store');
Route::get('/admin/category/index',[CategoryController::class,'categoryIndex'])->name('category.index');
Route::get('/admin/category/{id}',[CategoryController::class,'categoryDestroy'])->name('category.destroy');
Route::get('/admin/category/edit/{id}',[CategoryController::class,'categoryEdit'])->name('category.edit');
Route::get('/admin/category/store/{id}',[CategoryController::class,'categoryUpdate'])->name('category.update');


Route::get('/lotel/type/{type}',[LotelController::class,'typeLotel'])->name('typeLotel');

Route::get('/lotel/{id}',[HomeController::class,'lotelDetail'])->name('lotelDetail');
Route::get('/lotel/{id}/{checkin}/{checkout}',[HomeController::class,'lotelDetailFillter'])->name('lotelDetailFillter');



Route::get('/admin/lotel',[LotelController::class,'adminLotel'])->name('admin.lotel');
Route::get('/admin/lotel/index',[LotelController::class,'lotelIndex'])->name('lotel.index');
Route::get('/admin/lotel/search',[LotelController::class,'lotelSearch'])->name('lotel.search');
Route::get('/admin/lotel/create',[LotelController::class,'lotelCreate'])->name('lotel.create');
Route::post('/admin/lotel/up',[LotelController::class,'lotelStore'])->name('lotel.store');
Route::get('/admin/lotel/{id}',[LotelController::class,'lotelDestroy'])->name('lotel.destroy');
Route::get('/admin/lotel/edit/{id}',[LotelController::class,'lotelEdit'])->name('lotel.edit');
Route::post('/admin/lotel/store/{id}',[LotelController::class,'lotelUpdate'])->name('lotel.update');


Route::get('/admin/room',[RoomController::class,'adminRoom'])->name('admin.room');
Route::get('/admin/room/index/{id}',[RoomController::class,'roomIndex'])->name('room.index');
Route::get('/admin/room/create/{id}',[RoomController::class,'roomCreate'])->name('room.create');
Route::post('/admin/room/up/{id}',[RoomController::class,'roomStore'])->name('room.store');
Route::get('/admin/room/{id}',[RoomController::class,'roomDestroy'])->name('room.destroy');
Route::get('/admin/room/edit/{id}',[RoomController::class,'roomEdit'])->name('room.edit');
Route::post('/admin/room/store/{id}',[RoomController::class,'roomUpdate'])->name('room.update');


Route::get('/handbook',[HandbookController::class,'handbook'])->name('handbook');
Route::get('/handbook/{id}',[HandbookController::class,'handbookDetail'])->name('handbookDetail');
Route::get('/admin/handbook',[HandbookController::class,'handbookAdmin'])->name('admin.handbook');
Route::get('/admin/handbooks/index',[HandbookController::class,'handbookIndex'])->name('handbook.index');
Route::get('/admin/handbooks/create',[HandbookController::class,'handbookCreate'])->name('handbook.create');
Route::post('/admin/handbooks/up',[HandbookController::class,'handbookStore'])->name('handbook.store');
Route::get('/admin/handbooks/{id}',[HandbookController::class,'handbookDestroy'])->name('handbook.destroy');
Route::get('/admin/handbooks/edit/{id}',[HandbookController::class,'handbookEdit'])->name('handbook.edit');
Route::post('/admin/handbooks/store/{id}',[HandbookController::class,'handbookUpdate'])->name('handbook.update');

Route::get('/new',[NewsController::class,'news'])->name('news');
Route::get('/new/{id}',[NewsController::class,'newsDetail'])->name('newsDetail');
Route::get('/admin/news/index',[NewsController::class,'newsIndex'])->name('news.index');
Route::get('/admin/news/create',[NewsController::class,'newsCreate'])->name('news.create');
Route::post('/admin/news/up',[NewsController::class,'newsStore'])->name('news.store');
Route::get('/admin/news/{id}',[NewsController::class,'newsDestroy'])->name('news.destroy');
Route::get('/admin/news/edit/{id}',[NewsController::class,'newsEdit'])->name('news.edit');
Route::post('/admin/news/store/{id}',[NewsController::class,'newsUpdate'])->name('news.update');

Route::get('/location',[LocationController::class,'location'])->name('location');
Route::get('/admin/location/index',[LocationController::class,'locationIndex'])->name('location.index');
Route::get('/admin/location/create',[LocationController::class,'locationCreate'])->name('location.create');
Route::post('/admin/location/up',[LocationController::class,'locationStore'])->name('location.store');
Route::get('/admin/location/{id}',[LocationController::class,'locationDestroy'])->name('location.destroy');
Route::get('/admin/location/edit/{id}',[LocationController::class,'locationEdit'])->name('location.edit');
Route::post('/admin/location/store/{id}',[LocationController::class,'locationUpdate'])->name('location.update');

Route::get('/news',[HandbookController::class,'news'])->name('admin.news');
Route::get('/location',[HandbookController::class,'location'])->name('admin.location');





Route::get('/user/{id}',[AuthController::class,'userInfor'])->name('userInfor');
Route::get('/payment/{id}',[AuthController::class,'userPayment'])->name('userPayment');
Route::get('/user/{id}/edit',[AuthController::class,'userEdit'])->name('userEdit');
Route::post('/user/{id}/store',[AuthController::class,'updateUser'])->name('updateUser');

Route::get('/room/{id}',[RoomController::class,'room'])->name('room');
Route::get('/room/disable/{id}',[RoomController::class,'disable'])->name('disable');
Route::get('/room/able/{id}',[RoomController::class,'able'])->name('able');
Route::get('/room/{id}/{checkin}/{checkout}',[RoomController::class,'roomFillter'])->name('roomFillter');
Route::get('/history/{id}',[HistoryController::class,'history'])->name('history');

Route::middleware(['booking'])->group(function (){
    Route::get('/home',[HomeController::class,'home'])->name('home');
});
Route::get('/booking/{id}',[HomeController::class,'booking'])->name('booking');
Route::post('/admin/booking/store/{id}',[BookingController::class,'bookingStore'])->name('bookingStore');
Route::get('/admin/booking/{id}',[BookingController::class,'bookingDestroy'])->name('booking.destroy');

Route::get('/booking/cancel/{id}',[BookingController::class,'bookingCancel'])->name('bookingCancel');
Route::get('/booking/refuse/{id}',[BookingController::class,'bookingRefuse'])->name('bookingRefuse');
Route::get('/booking/confirm/{id}',[BookingController::class,'bookingConfirm'])->name('bookingConfirm');
Route::get('/booking/payment/{id}',[BookingController::class,'bookingPayment'])->name('bookingPayment');

Route::get('/order',[BookingController::class,'order'])->name('order');
Route::get('/admin/order/new',[BookingController::class,'orderNew'])->name('order.new');
Route::get('/admin/order/payment',[BookingController::class,'orderPayment'])->name('order.payment');
Route::get('/admin/order/profile',[BookingController::class,'orderProfile'])->name('order.profile');

Route::get('/print-order/{id}',[BillController::class,'print_order'])->name('print_order');

Route::get('/admin/equipment',[AdminController::class,'equipment'])->name('admin.equipment');
Route::get('/admin/equipment/create',[EquipmentController::class,'equipmentCreate'])->name('equipment.create');
Route::post('/admin/equipment/create',[EquipmentController::class,'equipmentStore'])->name('equipment.store');
Route::get('/admin/equipment/index',[EquipmentController::class,'equipmentIndex'])->name('equipment.index');
Route::get('/admin/equipment/{id}',[EquipmentController::class,'equipmentDestroy'])->name('equipment.destroy');
Route::get('/admin/equipment/edit/{id}',[EquipmentController::class,'equipmentEdit'])->name('equipment.edit');
Route::get('/admin/equipment/store/{id}',[EquipmentController::class,'equipmentUpdate'])->name('equipment.update');

Route::get('/located/{id}',[LotelController::class,'located'])->name('located');


Route::post('webhook', function(){
    return 'ok';
});
Route::name('stripe.')
    ->controller(StripeController::class)
    ->prefix('stripe')
    ->group(function () {
        Route::get('/payment/{id}', 'indexPayment')->name('indexPayment');
        Route::post('/payment/store/{id}', 'storePayment')->name('storePayment');
    });
    Route::group(['prefix' => 'composer require laravel/breeze --dev', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

Route::get('/admin/order/searchnew',[BookingController::class,'searchNew'])->name('searchNew');
Route::get('/admin/order/searchpay',[BookingController::class,'searchPay'])->name('searchPay');
Route::get('/admin/order/searchorder',[BookingController::class,'searchOrder'])->name('searchOrder');

