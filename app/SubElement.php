<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubElement extends Model
{
    //
    public $timestamps = false;
    public function element()
    {
        return $this->belongsTo('App\Element');
    }
}
