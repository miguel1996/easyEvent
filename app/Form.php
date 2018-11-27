<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Form
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Event $event
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Form_Element[] $form_elements
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Form newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Form newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Form query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Form whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Form whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Form whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
