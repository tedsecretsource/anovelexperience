<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class SubscriptionStatus extends Model
{
    use CrudTrait;

    protected $fillable = [
        'status'
    ];
}
