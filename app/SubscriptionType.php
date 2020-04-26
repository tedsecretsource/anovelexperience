<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class SubscriptionType extends Model
{
    use CrudTrait;

    protected $fillable = [
        'type'
    ];
}
