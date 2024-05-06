<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function post()   
    {
        return $this->hasMany(Post::class);  
    }
    
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'discover', 'user_id', 'post_id');
    }
    
    public function isDiscover($discover)
    {
        return $this->posts->where('post_id', $discover)->exists();
    }
    
    public function isNotDiscover($notDiscover)
    {
        return $this->posts()->where('post_id', $notDiscover)->exists();
    }
    
    public function discover($discover, $notDiscover)
    {
        if($this->isDiscover($discover) && !$this->isNotDiscover($notDiscover))
        {
            $this->posts()->detach($discover); 
        }
        elseif(!$this->isDiscover($discover) && $this->isNotDiscover($notDiscover))
        {
            $this->posts()->detach($notDisover);
            $this->posts()->attach($discover);
        }
        else
        {
            $this->posts()->attach($discover);    
        }
    }
    
    public function notDiscover($discover, $notDiscover)
    {
        if($this->isDiscover($discover) && !$this->isNotDiscover($notDiscover))
        {
            $this->posts()->detach($discover);
            $this->posts()->attach($notDiscover);
        }
        elseif(!$this->isDiscover($discover) && $this->isNotDiscover($notDiscover))
        {
            $this->posts()->detach($notDiscover);
        }
        else
        {
            $this->posts()->attach($notDiscover);
        }
    }
}
    
