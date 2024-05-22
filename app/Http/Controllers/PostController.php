<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostRequest;
use App\Models\Drink;
use App\Models\Post;
use App\Models\Prefecture;
use App\Models\City;
use App\Models\User;
use App\Models\Discover;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
    public function show(Post $post)
    {
        $discovery_counts = Discover::where('post_id', $post->id)
                          ->groupBy('user_id')
                          ->select('user_id', DB::raw('COUNT(*) as discoveries_count'))
                          ->get();
        
        return view('juice.show')->with([
            'post' => $post,
            'discovery_counts' => $discovery_counts
        ]);
    }
    
    public function create(Drink $drink, Prefecture $prefecture, City $city)
    {
        return view('juice.create')
        ->with(['drinks'=>$drink->get(), 
                'prefectures'=>$prefecture->prefecture(), 
                'cities'=>$city->city()
                ]);
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
        return view('juice.edit')
        ->with(['drinks'=>$drink->get(), 
                'prefectures'=>$prefecture->prefecture(), 
                'cities'=>$city->city()
                ]);

    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $input_post += ['user_id'=>$request->user()->id];
        $post->fill($input_post)->save();
        return redirect('/');
    }
    
    public function delete(Post $post)
    {
        if(Auth::id() == $post->user_id)
        {
            $post->delete();
            return redirect('/drinks/'.$post->drink_id)->with('success', '削除完了');
        }
        else
        {
            return redirect('/drinks/'.$post->drink_id)->with('failure', 'あなたが投稿したものではないため削除できません');
        }
    }
}
