<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Http\Request;
use App\Photo;
use App\Post;
use App\User;

class PostsController extends Controller
{

    public function index()
    {
        $posts = Post::withTrashed()->get();
        return view('posts.index', ['posts' => $posts]);
    }


    public function create()
    {
        $users = User::all();
        return view('posts.create', compact('users'));
    }



    //CreatePostRequest izricito za postove, tamo smo definisali validacije
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();

        if ($file = $request->file('file')) {
            $name = $file->getClientOriginalName();
            $file->move('uploads', $name);

            $input['path'] = $name;
        }
        if (Post::create($input))
            return redirect('posts');
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

        return view('posts.edit', compact('post', 'users'));
    }


    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($post->update($request->all()))
            return redirect('/posts');
    }


    public function destroy(Post $post)
    {
        if ($post->delete())
            return redirect('/posts');
    }


    public function restore(Post $post, $id)
    {
        if ($post->whereId($id)->restore())
            return redirect('/posts');
        else echo "greska";
    }


    public function contact()
    {
        return view("contact");
    }
}