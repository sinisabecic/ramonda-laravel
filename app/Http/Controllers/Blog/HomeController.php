<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('blog.posts',
            [
                'posts' => Post::orderBy('created_at', 'desc')->paginate(4)
            ]);
    }

    public function show($slug)
    {
        return view('blog.post',
            [
                'post' => Post::where('slug', $slug)->first()
            ]);
    }
}
