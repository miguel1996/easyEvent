<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User','subscriptions');
    }

    public function form()
    {
        return $this->hasOne("App\Form");
    }
}
