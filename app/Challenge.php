<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    public function questions()
    {
    return $this->hasMany(Question::class);

    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class);
    }
    
    public function topics()
    {
        return $this->belongsTo(TOpic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
