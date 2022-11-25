<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDashboard\FishTypeController;
use App\Http\Controllers\AdminDashboard\BoatController;
use App\Http\Controllers\AdminDashboard\FishLoadController;
use App\Http\Controllers\AdminDashboard\OrderController;
use App\Http\Controllers\AdminDashboard\ReportController;
use App\Http\Controllers\AdminDashboard\AgencyController;

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

Auth::routes();

//Admin dashboard routes
Route::group(['prefix' => 'admin-dashboard'], function () {

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::group(
        ['middleware' => 'auth'],
        function () {
            Route::get('/', [FishTypeController::class, 'index']);
            $resourses = [
                'fish_types' => FishTypeController::class,
                'agencies' => AgencyController::class,
                'boats' => BoatController::class,
                'loads' => FishLoadController::class,
                'orders' => OrderController::class,
            ];

            foreach ($resourses as $route => $controller) {
                Route::resource($route, $controller);
                Route::get($route . '/index/data', [$controller, 'indexData']);
            }

            Route::get('report-loads', [ReportController::class, 'reportLoads']);
            Route::get('report-loads/index/data', [ReportController::class, 'reportLoadsData']);
            Route::get('status/{order_id}/{status_id}' , [OrderController::class, 'changeOrderStatus']);
        }
    );
});


Route::group(['prefix' => 'agency-dashboard'], function () {
    Route::get('login', [LoginController::class, 'showAgencyLoginForm'])->name('agency.login');
    Route::post('login', [LoginController::class, 'agencyLogin'])->name('agency.login.submit');
    Route::group(
        ['middleware' => 'auth-agency'],
        function () {

            $resourses = [
                // 'agency_items' => 'ItemController',
                'agency_orders' => App\Http\Controllers\AgencyDashboard\OrderController::class,
            ];

            foreach ($resourses as $route => $controller) {

                Route::resource($route, $controller);
                Route::get($route . '/index/data', [$controller, 'indexData']);

            }
        }
    );
});