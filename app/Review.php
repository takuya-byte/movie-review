<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    
    public function favorite_users()
    {
            return $this->belongsToMany(User::class,'favorites','review_id','user_id')->withTimestamps();
    }
}
