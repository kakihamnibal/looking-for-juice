<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Drink;
use App\Models\Prefecture;

class DrinkController extends Controller
{
    public function home(Drink $drink)
    {
        return view('juice.home')->with(['drinks'=>$drink->get()]);
    }
    
   public function index(Drink $drink, Request $request)
    {
        $drinkInfo = $drink->find($drink->id);
    
        return view('juice.index')->with([
            'posts' => $drink->getByDrink(),
            'drink' => $drinkInfo
        ]);
    }
    
}