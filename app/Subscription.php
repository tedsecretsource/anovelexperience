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
        'type',
        'status',
        'payment_confirmation_id',
        'payment_date',
        'payment_amount',
        'payment_status',
        'first_entry_date',
        'pace',
        'hash'
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
