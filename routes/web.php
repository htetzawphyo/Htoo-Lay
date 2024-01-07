<?php

use App\Livewire\Back\AdminSidebar;
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

use Livewire\Volt\Volt;

Volt::route('/', 'front.home');

Volt::route('/admin/login', 'auth.login');

Volt::route('/admin/dashboard', 'back.dashboard');
// Volt::route('/admin/dashboard', AdminSidebar::class);
Volt::route('/admin/products', 'back.products.product-list');
Volt::route('/admin/products/add', 'back.products.product-add');
Volt::route('/admin/products/view/{id}', 'back.products.product-detail');

Volt::route('/admin/categories', 'back.category.category-list');
VOlt::route('/admin/category/add', 'back.category.category-add');
Volt::route('/admin/category/view/{id}', 'back.category.category-detail');

// Route::get('/', function () {
//     return view('welcome');
// });
