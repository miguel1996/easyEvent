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
 * App\Element
 *
 * @property int $id
 * @property string $label
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Event[] $events
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SubElement[] $subElements
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Element newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Element newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Element query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Element whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Element whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Element whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Element whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Element whereUpdatedAt($value)
 */
	class Element extends \Eloquent {}
}

namespace App{
/**
 * App\Event
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image_path
 * @property string $event_date
 * @property string $opening_subscription_date
 * @property string $closing_subscription_date
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Element[] $elements
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereClosingSubscriptionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereEventDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereOpeningSubscriptionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereUserId($value)
 */
	class Event extends \Eloquent {}
}

namespace App{
/**
 * App\Group
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereName($value)
 */
	class Group extends \Eloquent {}
}

namespace App{
/**
 * App\SubElement
 *
 * @property int $id
 * @property string $name
 * @property int $element_id
 * @property-read \App\Element $element
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubElement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubElement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubElement query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubElement whereElementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubElement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubElement whereName($value)
 */
	class SubElement extends \Eloquent {}
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
 * @property string $date_of_birth
 * @property string $address
 * @property int|null $phone_number
 * @property string $gender
 * @property int $group_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Event[] $events
 * @property-read \App\Group $group
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

