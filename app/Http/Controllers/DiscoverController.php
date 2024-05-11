<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discover;
use App\Models\User;
use Auth;
use App\Models\Post;

class DiscoverController extends Controller
{
    public function storeDiscovery($postId)
    {
        Auth::user()->discovery($postId);
        return 'ok!';
    }

    public function destroyDiscovery($postId)
    {
        Auth::user()->noDiscovery($postId);
        return 'ok!'; 
    }
}