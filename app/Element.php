<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    public function events(){
        return $this->belongsToMany('App\Event','events_elements');
    }

    public function subElements()
    {
        return $this->hasMany('App\SubElement');
    }
}
