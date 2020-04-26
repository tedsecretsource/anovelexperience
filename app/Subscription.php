<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use CrudTrait;

    protected $fillable = [
        'user_id',
        'novel_id',
        'subscribed',
        'type_id',
        'status_id',
        'payment_confirmation_id',
        'payment_date',
        'first_entry_date',
        'pace'
    ];

    public function subscriber()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function type()
    {
        return $this->belongsTo(SubscriptionType::class);
    }
    public function status()
    {
        return $this->belongsTo(SubscriptionStatus::class);
    }
    public function novel()
    {
        return $this->belongsTo(Novel::class);
    }

    public function scopeActiveSubscriptions($query)
    {
        return $query->where('status_id', 1)->orWhere('status_id', 4);
    }
}
