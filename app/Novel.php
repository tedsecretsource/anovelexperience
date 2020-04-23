<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Novel extends Model
{
    use CrudTrait;
    use SoftDeletes;

    protected $fillable = [
        'title', 'author', 'published', 'first_entry_date', 'summary', 'subscriptions', 'novel_emoji',
    ];

    protected $table = 'novels';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
