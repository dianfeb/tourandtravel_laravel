<?php

use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\WhyusController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dashboard', [DashboardController::class, 'index']);

Route::resource('/categories', CategoryController::class)->only([
    'index', 'store', 'update', 'destroy'
]);

Route::resource('/article', ArticleController::class);

// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['guest']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::resource('/slider', SliderController::class);
Route::resource('/whyus', WhyusController::class);
Route::get('/page', [PageController::class, 'index']);
Route::get('page/{id}/edit', [PageController::class, 'edit']);
Route::PUT('page/{id}/edit', [PageController::class, 'update']);
