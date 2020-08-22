<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    
    public function favorites()
    {
        return $this->belongsToMany(Review::class,'favorites','user_id','review_id')->withTimestamps();
    }
    
    public function favorite($reviewId)
    {
        $exist = $this->is_favorite($reviewId);
        
        if($exist){
            return false;
            
        }else{
            $this->favorites()->attach($reviewId);
            return true;
        }
    }
    
    public function unfavorite($reviewId)
    {
        $exist = $this->is_favorite($reviewId);

        if($exist){
            $this->favorites()->detach($reviewId);
            return true;
        }else{
            return false;
        }
    }

    public function is_favorite($reviewId)
    {
        return $this->favorites()->where('review_id',$reviewId)->exists();
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadCount(['reviews','favorites']);
    }
    
}
