<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class SentLog extends Model
{
    use CrudTrait;

    protected $fillable = [
        'subscription_id',
        'entry_id',
        'user_id'
    ];

    public function subscription()
    {
        return $this->belongsTo(App\Subscription::class);
    }

    public function entry()
    {
        return $this->belongsTo(App\Entry::class);
    }

    public function user()
    {
        return $this->belongsTo(App\User::class);
    }
}
