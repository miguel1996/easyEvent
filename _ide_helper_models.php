<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Event
 *
 * @property int $id
 * @property string $title
 * @property int $form_id
 * @property-read \App\Form $form
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereTitle($value)
 * @mixin \Eloquent
 */
	class Event extends \Eloquent {}
}

namespace App{
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
	class Form extends \Eloquent {}
}

namespace App{
/**
 * App\Form_Element
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Form_Subscription_Element[] $form_subscription_elements
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Form_Element newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Form_Element newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Form_Element query()
 * @mixin \Eloquent
 */
	class Form_Element extends \Eloquent {}
}

namespace App{
/**
 * App\Form_Subscription_Element
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Form_Subscription_Element newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Form_Subscription_Element newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Form_Subscription_Element query()
 * @mixin \Eloquent
 */
	class Form_Subscription_Element extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Event[] $events
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

