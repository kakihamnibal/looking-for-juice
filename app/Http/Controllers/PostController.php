<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Drink;
use App\Models\Post;

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
    
    public function create(Drink $drink)
    {
        return view('juice.create')->with(['drinks'=>$drink->get()]);
    }
    
    public function store(Post $post, PostRequest $request)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/');
    }
    
}
