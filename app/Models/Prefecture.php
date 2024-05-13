<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;
    
    public function prefecture()
    {
        return Prefecture::orderBy('id', 'ASC')->get();
    }
    
    public function city()
    {
        return $this->hasMany(City::class);
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
}
