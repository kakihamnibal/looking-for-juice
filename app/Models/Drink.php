<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    use HasFactory;
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function getByDrink(int $limit_count = 10)
    {
        return $this->posts()->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
