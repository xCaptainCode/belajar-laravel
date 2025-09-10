<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
  return view('welcome');
});

Route::get('/', function () {
  return view('home', ['title' => 'Home']);
});

Route::get('/about', function () {
  return view('about', ['title' => 'About']);
});

Route::get('/posts', function () {
  
  if (request('search')) {
    // jika request search  set 'title' => Blog
    $title = 'Blog';
  } elseif (request('category')) {
    // jika request category set 'title' => "Articel in " . "\"$category->category\""
    $category = Category::where('slug', request('category'))->first();
    $title = 'Articel in ' . "\"{$category->category}\"";
  } elseif (request('author')) {
    // jika request author set 'title' => count($user->posts) . ' Articles By ' . $user->name
    $user = User::where('name', request('author'))->first();
    $title = count($user->posts) . ' Articles By ' . $user->name;
  } else {
    $title = 'Blog';
  }
  
  
  return view('posts', [ 'title' => $title,  'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(6)->withQueryString()]);

});

Route::get('/posts/{post:slug}', function (Post $post) {

  return view('post', ['title' => 'Single Post', 'post' => $post]);
  
});

Route::get('/authors/{user:name}', function (User $user) {

  return view('posts', ['title' => count($user->posts) . ' Articles By ' . $user->name, 'posts' => $user->posts]);
  
});

Route::get('/categories/{category:slug}', function (Category $category) {

  return view('posts', ['title' => 'Articel in ' . "\"$category->category\"", 'posts' => $category->posts]);
  
});

Route::get('/contact', function () {
  return view('contact', [
    'title' => 'Contact',
    'email' => 'z4WbA@example.com',
    'phone' => '08123456789',
  ]);
});
