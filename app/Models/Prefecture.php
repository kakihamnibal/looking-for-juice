<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;
    
    public function city()
    {
        return $this->hasMany(City::class);
    }
    
    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
