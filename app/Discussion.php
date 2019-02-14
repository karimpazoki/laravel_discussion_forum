<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ["channel_id", 'user_id', 'title', 'content', "slug"];

    public function channel()
    {
        return $this->belongsTo("App\Channel");
    }

    public function replies()
    {
        return $this->hasMany("App\Reply");
    }

    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
