<?php

use App\Http\Controllers\Auth\Stores\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckUserType;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:web,store'])->name('dashboard');

require __DIR__.'/auth.php';

/*
Route::get('/stores/login', [LoginController::class, 'create'])
                ->middleware('guest:store')
                ->name('stores.login');

Route::post('/stores/login', [LoginController::class, 'store'])
                ->middleware('guest:store');
*/

Route::namespace('Admin')
    ->prefix('admin')
    ->as('admin.')
    ->middleware('auth', 'user.type:user')
    ->group(function() {

        Route::group([
            'prefix' => 'categories',
            'as' => 'categories.',
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
        
        Route::resource('products', 'ProductsController')->names([
            'index' => 'products.index',
        ]);
    });


//Route::resource('admin/categories', 'Admin\CategoriesController');

Route::get('admin/tags/{id}/products', [TagsController::class, 'products']);

Route::get('admin/users/{id}', [UsersController::class, 'show'])->name('admin.users.show');

Route::prefix('admin/categories')
    ->namespace('Admin')
    ->as('admin.categories.')
    ->group(function() {
        
    });

Route::get('regexp', function() {

    $test = '059-1234567,059-2332,059-22222';
    $exp = '/^(059|056)\-?([0-9]{7})$/';

    $email = 'last-name_12@domain';
    $pattern = '/^[a-zA-Z0-9]+[a-zA-Z0-9\.\-_]*@[a-zA-Z0-9]+[a-zA-Z0-9\.\-]*[a-zA-Z]+$/';

    preg_match($pattern, $email, $matches);
    dd($matches);

});
