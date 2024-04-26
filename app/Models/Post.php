<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
    'title',
    'body',
    'drink_id',
    'user_id'
    ];
   
    public function getPaginateByLimit(int $limit_count = 10)
    {
    return $this::with('drink' ,'user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function drink()
    {
        return $this->belongsTo(Drink::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
}
