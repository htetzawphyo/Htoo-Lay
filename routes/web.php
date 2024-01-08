<?php

use App\Livewire\Back\AdminSidebar;
use Illuminate\Support\Facades\Route;

use Livewire\Volt\Volt;

Volt::route('/', 'front.home');

Volt::route('/admin/login', 'auth.login');

Volt::route('/admin/dashboard', 'back.dashboard')->middleware('admin');
Volt::route('/admin/products', 'back.products.product-list')->middleware('admin');
Volt::route('/admin/products/add', 'back.products.product-add')->middleware('admin');
Volt::route('/admin/products/add-discount', 'back.products.discount-add')->middleware('admin');
Volt::route('/admin/products/view/{id}', 'back.products.product-detail')->middleware('admin');

Volt::route('/admin/categories', 'back.category.category-list')->middleware('admin');
VOlt::route('/admin/category/add', 'back.category.category-add')->middleware('admin');
Volt::route('/admin/category/view/{id}', 'back.category.category-detail')->middleware('admin');

Route::fallback(fn() => view('livewire/404'));
