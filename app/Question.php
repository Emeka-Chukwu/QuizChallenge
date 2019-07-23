<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function challenges()
    {
        return $this->belongsTo(Challenge::class, 'challenge_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function user()
    {
        return $this->hasManyThrough(User::class,Challenge::class);
    }
}
