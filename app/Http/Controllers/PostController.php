<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Drink;
use App\Models\Post;
use App\Models\Prefecture;
use App\Models\city;

class PostController extends Controller
{
    public function home(Drink $drink)
    {
        return view('juice.home')->with(['drinks'=>$drink->get()]);
    }
    
   public function index(Post $post)
    {
        return view('juice.index')->with(['posts'=>$post->getPaginateByLimit()]);
    }
    
    public function show(Post $post)
    {
        return view('juice.show')->with(['post'=>$post]);
    }
    
    public function create(Drink $drink)
    {
        return view('juice.create')->with(['drinks'=>$drink->get()]);
    }
    
    public function store(Post $post, PostRequest $request)
    {
        $input = $request['post'];
        $input += ['user_id'=>$request->user()->id];
        $post->fill($input)->save();
        return redirect('/');
    }
    
    public function edit(Post $post)
    {
        $drink = Drink::all();
        return view('juice.edit')->with(['post'=>$post, 'drinks'=>$drink]);

    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $input += ['user_id'=>$request->user()->id];
        $post->fill($input_post)->save();
        return redirect('/');
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/drinks/'.$post->drink_id);
    }
}
