<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    use CrudTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function isSubscribed($id)
    {
        $sub = $this->subscriptions
            ->where('novel_id', $id)
            ->where('status', '!=', 'canceled')
            ->where('status', '!=', 'fulfilled');
        return (bool)$sub->count();
    }

    public function activeSubscriptionsCount($id)
    {
        $sub = $this->subscriptions
            ->where('novel_id', $id)
            ->where('status', '!=', 'canceled')
            ->where('status', '!=', 'fulfilled');
        return $sub->count();
    }
}
