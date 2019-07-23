<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Answer extends Model
{
    public function questions()
    {
        return $this->belongsTo(Question::class);
    }
}
