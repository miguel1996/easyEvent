<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Form_Element
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Form_Subscription_Element[] $form_subscription_elements
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Form_Element newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Form_Element newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Form_Element query()
 * @mixin \Eloquent
 */
class Form_Element extends Model
{
    protected $table = 'form_elements';

    public function form_subscription_elements()
    {
        return $this->hasMany("App\Form_Subscription_Element","form_elements_id");
    }
}
