<?php

use App\Models\Category;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Api\CategoryApi;
use App\Http\Controllers\back\UserController;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\ReservasiController;
use App\Models\User;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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



Route::group(['prefix' => 'api'], function () {});

Route::group(['middleware' => 'auth'], function () {});




// Route middleware spatie
Route::group(['middleware' => ['role:editor|admin']], function () {
    Route::resource("/articles", ArticleController::class);
    Route::resource("/categories", CategoryController::class)->only(['index', 'store', 'update', 'destroy']);
});
// Route middleware spatie
Route::group(['middleware' => ['role:admin']], function () {
    Route::get("/dashboard", [DashboardController::class, 'index']);
    Route::resource("/users", UserController::class);
    Route::post('/categories', [CategoryApi::class, 'store']);
    Route::resource("/reservations", ReservasiController::class);
});
Route::group(['middleware' => ['permission:publish articles']], function () {});
Route::group(['middleware' => ['role_or_permission:publish articles']], function () {});




// Route test add permission
Route::get('give-permission-to-role', function () {

    // $role = Role::findOrFail(1);  //author
    // $permission = Permission::findOrFail(1); //create article


    // $role = Role::findOrFail(2);  //editor
    // $permission = Permission::findOrFail(2); //edit article


    $role = Role::findOrFail(3);  //moderator
    $permission1 = Permission::findOrFail(1); // create article
    $permission2 = Permission::findOrFail(2); // edit article
    $permission3 = Permission::findOrFail(3); // delete article

    // $role->givePermissionTo([$permission1, $permission2, $permission3]);

    echo "ok";
});


Route::get('assign-role-to-user', function () {

    $user = User::findOrFail(3); // Toni
    $role = Role::findOrFail(3); // Author

    $user->assignRole($role);
});



// Route File Manager 
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


// Route Auth Stater Kit Laravel
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
