<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;

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

Route::get('/', [FrontController::class, 'index'])->name('home');

Route::get('/quienes-somos', function () {
    return view('front.about');
})->name('about');

Route::get('/novedades', [FrontController::class, 'posts'])->name('news');

Route::get('/novedades/{slug}', [FrontController::class, 'postView'])->name('news.view');

Route::post('/voluntariado', [FrontController::class, 'sendMail'])->name('mail.send');


Route::group(['prefix' => 'admin'], function(){

    Auth::routes();

    Route::group(['middleware' => 'auth'], function(){
        //Home
        Route::get('/admin/users/{id}', [UsersController::class, 'show'])->name('users.show');
        Route::get('/', [HomeController::class, 'index'])->name('admin.home');
        //Categories
        Route::resource('/categories', CategoriesController::class);
        Route::get('/categories/delete/{category}', [CategoriesController::class, 'destroy'])->name('categories.delete');
        //Users
        Route::resource('/users', UsersController::class);
        Route::get('/users/delete/{user}', [UsersController::class, 'destroy'])->name('users.delete');
        Route::get('/admin/users/search', [UsersController::class, 'search'])->name('users.search');
        Route::get('/admin/users/{id}/pdf', [App\Http\Controllers\UsersController::class, 'generatePDF'])->name('users.pdf');
        //Posts
        Route::resource('/posts', PostsController::class);
        Route::get('/posts/delete/{post}', [PostsController::class, 'destroy'])->name('posts.delete');
        //Photos
        Route::get('/posts/{post}/photos', [PostsController::class, 'photosIndex'])->name('posts.photos.index');
        Route::get('/posts/{post}/photos/create', [PostsController::class, 'photosCreate'])->name('posts.photos.create');
        Route::post('/posts/{post}/photos', [PostsController::class, 'photosStore'])->name('posts.photos.store');
        Route::get('/posts/{post}/photos/delete/{photo}', [PostsController::class, 'photosDestroy'])->name('posts.photos.delete');
    });
});


