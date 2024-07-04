<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Drink;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Auth;

class DrinkController extends Controller
{
    public function home(Drink $drink)
    {
        return view('juice.home')->with(['drinks'=>$drink->get()]);
    }
    
   public function index(Drink $drink, Prefecture $prefecture)
    {
        $drinkInfo = $drink->find($drink->id);
        $userId = Auth::id();
        
        return view('juice.index')->with([
            'posts' => $drink->getByDrink(),
            'drink' => $drinkInfo,
            'prefectures' => $prefecture->prefecture(),
            'userId' => $userId
        ]);
    }
    
   public function serchPref(Drink $drink, Prefecture $prefecture)
    {
        $drinkInfo = $drink->find($drink->id);
        $drinkPosts = $drink->getByDrinkAndPref();
        $prefAndDrink = $prefecture->getByPrefecture();
        $prefName = $prefecture->find($prefecture->id);
        $userId = Auth::id();
        
        $posts = $drinkPosts->whereIn('id', $prefAndDrink->pluck('id'))->paginate(10);
        //$drinkに含まれる投稿のうちprefecturerに関連付けられた投稿をページネーションして$postsに格納している
        //pluckで連想配列のキーを指定してそれに対応した値を入手する
        
        return view('prefCategory.index')->with([
            'posts' => $posts,
            'drink' => $drinkInfo,
            'prefectures' => $prefecture->prefecture(),
            'prefName' => $prefName,
            'userId' => $userId
        ]);
    }


}