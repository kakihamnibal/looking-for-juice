<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discover;
use Auth;

class DiscoverController extends Controller
{
    public function store(Request $request)
    {
        $discover = $request->input('discover');
        $notDiscover = $request->input('not_discover');
        
        Auth::user()->discover($discover, $notDiscover);
        
        return 'ok!'; 
    }

    public function destroy(Request $request)
    {
        $discover = $request->input('discover');
        $notDiscover = $request->input('not_discover');
        
        Auth::user()->notDiscover($discover, $notDiscover);
        
        return 'ok!'; 
    }
}