<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/welcome', function () {
  return view('welcome');
});

Route::get('/', function () {
  return view('home', ['title' => 'Home']);
});

Route::get('/about', function () {
  return view('about', ['title' => 'About']);
});

Route::resource('posts', PostController::class);

Route::get('/contact', function () {
  return view('contact', [
    'title' => 'Contact',
    'email' => 'z4WbA@example.com',
    'phone' => '08123456789',
  ]);
});
