<?php

use App\Http\Controllers\Admin\CategoriesController;
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

Route::view('/', 'welcome');

// 'DashboardController@index'
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

Route::group([
    'prefix' => 'admin/categories',
    'namespace' => 'Admin',
    'as' => 'admin.categories.',
], function() {
    // admin.categories.index
    Route::get('/', 'CategoriesController@index')->name('index');
   
    // admin.categories.create
    Route::get('/create', 'CategoriesController@create')->name('create');
    Route::get('/{id}', 'CategoriesController@show')->name('show');
    Route::post('/', [CategoriesController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [CategoriesController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CategoriesController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoriesController::class, 'destroy'])->name('destroy');
});

//Route::resource('admin/categories', 'Admin\CategoriesController');


/*
Route::prefix('admin/categories')
    ->namespace('Admin')
    ->as('admin.categories.')
    ->group(function() {
        
    });
*/

