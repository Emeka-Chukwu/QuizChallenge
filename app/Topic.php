<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function subjects()
    {
        return $this->belongsTo(Subject::class);
    }

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }
}
