<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    public function event()
    {
        return $this->hasOne("App\Event");
    }

    public function form_elements()
    {
        return $this->hasMany("App\Form_Element");
    }
}
