<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    
    public function city()
    {
        return City::orderBy('id', 'ASC')->get();
    }
    
    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }
    
    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
