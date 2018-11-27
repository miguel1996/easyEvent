<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_Element extends Model
{
    protected $table = 'form_elements';

    public function form_subscription_elements()
    {
        return $this->hasMany("App\Form_Subscription_Element","form_elements_id");
    }
}
