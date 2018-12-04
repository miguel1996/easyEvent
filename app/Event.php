<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User','subscriptions')->withPivot('data');
    }

    public function elements(){
        return $this->belongsToMany('App\Element','events_elements');
    }
}
