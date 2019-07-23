<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }
}
