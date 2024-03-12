<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PromotionController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\TransactionsController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Clients\ClientsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Khang
Route::controller(ClientsController::class)->group(function () {
    Route::get('/', 'index')->name('client.page.home.index');
    Route::get('/product', 'page_product')->name('client.page.product');
    Route::get('/product/{id}', 'detail')->name('client.page.detail');
    Route::get('/cart', 'cart')->name('client.page.cart');
    Route::post('/cart/add', 'addToCart')->name('client.add.cart');
    Route::put('/cart/update', 'updateCart')->name('client.update.cart');
    Route::delete('/cart/remove', 'removeItem')->name('client.remove.cart');
    Route::delete('/cart/clear', 'clearCart')->name('client.clear.cart');
    Route::get('/cart/checkout', 'checkOut')->name('client.cart.checkout');
    Route::post('/cart/checkout', 'order');
    Route::get('/order', 'order_list');
    Route::get('/order_cancel/{id}', 'cancel_order')->name('client.order.cancel');
    Route::get('/order/{id}', 'order_detail')->name('client.order.detail');
    Route::get('/nopermision', 'nopermision')->name('nopermision');
    Route::get('/about', 'about');
    Route::get('/addinfoship', 'add_info_ship');
    Route::post('/addinfoship', 'post_info');
    Route::get('/info/{id}', 'delete_info')->name('client.delete.info');
    Route::get('/createVNPAY/{id}/{amout}', 'createVNPAY')->name('request.pay');
    Route::get('/vnpay_return', 'returnVNPAY');
});
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
    Route::get('logout', 'logout')->name('logout');
});

Route::middleware('auth', 'user-role')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.page.dashboard');
        Route::controller(CategoryController::class)->prefix('/category')->group(function () {
            Route::get('/', 'index')->name('admin.page.category.index');
            Route::get('/add', 'create')->name('admin.page.category.create');
            Route::post('/add',  'store');
            Route::get('/update/{id}', 'edit')->name('admin.page.category.edit');
            Route::post('/update/{id}',  'update');
            Route::delete('/{id}',  'destroy')->name('admin.page.category.delete')->middleware('admin');
        });
        Route::controller(PromotionController::class)->prefix('/promotion')->group(function () {
            Route::get('/', 'index')->name('admin.page.promotion.index');
            Route::get('/add', 'create')->name('admin.page.promotion.create');
            Route::post('/add', 'store');
            Route::get('/update/{id}', 'edit')->name('admin.page.promotion.edit');
            Route::post('/update/{id}', 'update');
            Route::delete('/{id}', 'destroy')->name('admin.page.promotion.delete')->middleware('admin');
        });
        Route::controller(ProductController::class)->prefix('/product')->group(function () {
            Route::get('/', 'index')->name('admin.page.product.index');
            Route::get('/traxe/{id}', 'traXe')->name('admin.page.product.traxe');
            Route::post('/search', 'search')->name('admin.page.product.search');
            Route::get('/add', 'create')->name('admin.page.product.create');
            Route::post('/add', 'store');
            Route::get('/update/{id}', 'edit')->name('admin.page.product.edit');
            Route::post('/update/{id}', 'update');
            Route::delete('/{id}', 'destroy')->name('admin.page.product.delete')->middleware('admin');
        });
        Route::controller(SupplierController::class)->prefix('/supplier')->group(function () {
            Route::get('/', 'index')->name('admin.page.supplier.index');
            Route::get('/add', 'create')->name('admin.page.supplier.create');
            Route::post('/add', 'store');
            Route::get('/update/{id}', 'edit')->name('admin.page.supllier.edit');
            Route::post('/update/{id}', 'update');
            Route::delete('/{id}', 'destroy')->name('admin.page.supllier.delete')->middleware('admin');
        });
        Route::controller(UsersController::class)->prefix('/user')->group(function () {
            Route::get('/', 'index')->name('admin.page.user.index');
            Route::post('/search', 'search')->name('admin.page.user.seach');
            Route::middleware('admin')->group(function () {
                Route::get('/add', 'create')->name('admin.page.user.create');
                Route::post('/add', 'store');
                Route::get('/update/{id}', 'edit')->name('admin.page.user.edit');
                Route::post('/update/{id}', 'update');
                Route::delete('/{id}', 'destroy')->name('admin.page.user.delete');
            });
        });
        Route::controller(OrderController::class)->prefix('/order')->group(function () {
            Route::get('/', 'index')->name('admin.page.order.index');
            Route::get('/detail/{id}', 'details')->name('admin.page.order.detail');
            Route::post('/', 'updateStatus');
            Route::get('/edit/{id}', 'edit')->name('admin.page.order.edit');
            Route::post('/edit/{id}', 'update');
            Route::delete('/{id}', 'destroy')->name('admin.page.order.delete');
            Route::get('/send_mail', 'sendMail');
        });
        Route::controller(TransactionsController::class)->prefix('/transaction')->group(function () {
            Route::get('/', 'index');
        });
        Route::controller(BannerController::class)->prefix('/banner')->group(function () {
            Route::get('/', 'index')->name('admin.page.banner');
            Route::get('/add', 'create')->name('admin.page.banner.create');
            Route::post('/add', 'store');
            Route::get('/update/{id}', 'edit')->name('admin.page.banner.edit');
            Route::post('/update/{id}', 'update');
        });
    });
});
