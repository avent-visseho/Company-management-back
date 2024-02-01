<?php
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

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

Route::controller(OrderController::class)->group(function(){
    Route::get('/add/order','indexOrder')->name('Order');
    Route::post('store/order',"storeOrder")->name('storeOrder');
    Route::get('/edit/order/{id}','editOrder')->name('editOrder');
    Route::post('/update/order/{id}','updateOrder')->name('updateOrder');
    Route::get('delete/order/{id}','deleteOrder')->name('deleteOrder'); 
});

