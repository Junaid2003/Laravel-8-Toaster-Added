<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChangePass;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Multipic;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

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

Route::get('/email/verify', function () {

    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $portfolio_images = Multipic::all();
    return view('home', compact('brands', 'abouts', 'portfolio_images'));
});

Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'update']);

Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);

Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/pdelete/category/{id}', [CategoryController::class, 'Pdelete']);

// For Brand Route

Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');

Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);

Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

// Multi Image Route

Route::get('/multi/image', [BrandController::class, 'Multipic'])->name('multi.image');
Route::post('/multi/add', [BrandController::class, 'StoreImage'])->name('store.image');

// Admin All Route
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');

Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');

Route::get('/slider/edit/{id}', [HomeController::class, 'Edit']);
Route::post('/slider/update/{id}', [HomeController::class, 'Update']);

Route::get('/slider/delete/{id}', [HomeController::class, 'Delete']);

// Home About All Route
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');

Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');

Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);
Route::post('/update/homeabout/{id}', [AboutController::class, 'UpdateAbout']);

Route::get('/about/delete/{id}', [AboutController::class, 'DeleteAbout']);

// Portfolio Page Route

Route::get('/portfolio', [AboutController::class, 'Portfolio'])->name('portfolio');


// Admin Contact page Route

Route::get('/admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');

Route::post('/admin/store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');


Route::get('/contact/edit/{id}', [ContactController::class, 'EditContact']);
Route::post('/update/contact/{id}', [ContactController::class, 'UpdateContact']);

Route::get('/contact/delete/{id}', [ContactController::class, 'DeleteContact']);

Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');
// Home Contact Page Route

Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');

Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');


// Change Password and user profile Route

Route::get('/user/password', [ChangePass::class, 'CPassword'])->name('change.password');

Route::post('/password/update', [ChangePass::class, 'UpdatePassword'])->name('password.update');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    
    // $users= User::all();
    return view('admin.index');
})->name('dashboard');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [ContactController::class, 'show']);
    


Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');

// user profile

Route::get('/user/profile', [ChangePass::class, 'PUpdate'])->name('profile.update');
Route::post('/user/profile/update', [ChangePass::class, 'UpdateProfile'])->name('update.user.profile');
