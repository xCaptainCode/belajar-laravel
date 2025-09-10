<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
  // menampilkan semua artikel (read)
  public function index()
  {
    $title = "Blog";

    if (request('search')) {
      $title = 'Blog';
    } elseif (request('category')) {
      $category = Category::where('slug', request('category'))->first();
      $title = 'Articel in ' . "\"{$category->category}\"";
    } elseif (request('author')) {
      $user = User::where('name', request('author'))->first();
      $title = count($user->posts) . ' Articles By ' . $user->name;
    }

    return view('posts', [
      'title' => $title,
      'posts' => Post::filter(request(['search', 'category', 'author']))
        ->latest()
        ->paginate(6)
        ->withQueryString()
    ]);
  }

  // menampilkan single post
  public function show($slug)
  {
    $post = Post::where('slug', $slug)->firstOrFail();
    return view('post', [
      'title' => 'Single Post',
      'post' => $post
    ]);
  }

  // Form create
  public function create()
  {
    return view('create', [
      'title' => 'Create New Article',
      'categories' => Category::all()
    ]);
  }

  // Simpan data artiket (Create)
  public function store(Request $request)
  {

    $validate = $request->validate([
      'title'       => 'required|max:255',
      // 'slug'        => 'required|unique:posts',
      'category_id' => 'required|exists:categories,id',
      'content'     => 'required',
    ]);

    try {
      // generate slug otomatis dari title
      $validate['slug'] = Str::slug($request->title);
      // cek apakah slug sudah ada
      if (Post::where('slug', $validate['slug'])->exists()) {
        return back()->withErrors(['slug' => 'Slug sudah digunakan.'])->withInput();
      }
      // anggap author sementara login user id 10
      $validate['author_id'] =  1; // sementara nanti diganti auth()->id() ??

      Post::create($validate);

      return redirect('/posts')->with('success', 'Artiker berhasil dibuat!');
    } catch (\Exception $e) {
      // log error message
      Log::error("Gagal membuat artikel: " . $e->getMessage());
      return redirect()->back()
        ->withInput() // kembali ke form sebelumnya
        ->with('error', 'Terjadi kesalahan saat membuat artikel.');
    }
  }
}
