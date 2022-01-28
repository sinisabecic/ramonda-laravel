<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use function redirect;
use function view;
use Illuminate\Support\Str;

class PostsController extends Controller
{

    public function index()
    {
        $users = User::withTrashed()->get();
        $posts = Post::withTrashed()->get();
        return view('admin.posts.index', ['posts' => $posts, 'users' => $users]);
    }


    public function create()
    {
        $users = User::all();
        return view('admin.posts.create', compact('users'));
    }


    //CreatePostRequest izricito za postove, tamo smo definisali validacije
    public function store()
    {
        $post = new Post;

        $inputs = request()->validate([
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'user_id' => ['required', 'string', 'max:255'],
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (request()->hasFile('banner')) {
            $file = request()->file('banner');
            $banner = $file->getClientOriginalName();
            request()->file('banner')->storeAs('banners/' . $banner, '');
            $inputs['banner'] = $banner;
        }
        $post->create($inputs);

    }


    public function show($id)
    {
        $post = Post::findOrFail($id);
        // return view('post')->with('id', $id);
        //? ili
        return view('posts.show', compact('post'));
    }


    public function edit($id)
    {
        $users = User::all();
        $post = Post::findOrFail($id);

        return view('admin.posts.edit', compact('post', 'users'));
    }


    public function update(Post $post)
    {
        $inputs = request()->validate([
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'user_id' => ['required', 'string', 'max:255'],
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (request()->hasFile('banner')) {
            $file = request()->file('banner');
            $banner = $file->getClientOriginalName();
            request()->file('banner')->storeAs('banners/' . $banner, '');
            $post->banner = $banner;
        }

        $post->title = $inputs['title'];
        $post->content = $inputs['content'];
        $post->user_id = $inputs['user_id'];
        $post->update();

    }


    public function destroy(Post $post)
    {
        $post->delete();
    }


    public function restore(Post $post, $id)
    {
        $post->whereId($id)->restore();
    }


    public function remove($id)
    {
        Post::where('id', $id)->forceDelete();
//        $user->forceDelete();
//            return redirect('/users');

        return response()->json();
    }
}
