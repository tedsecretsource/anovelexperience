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
    protected $dates = [
        'published',
        'first_entry_date',
        'last_entry_date'
    ];

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function duration($pace = 1, $format = 'days')
    {
        // get the days
        // divide by pace
        $days = (int) ceil($this->first_entry_date->diffInDays($this->last_entry_date) / $pace);
        // return as days (default) or as weeks / months (human)
        if ('days' === $format) {
            return $days;
        } else {
            // add days to first_entry_date
            $newenddate = $this->first_entry_date->addDays($days);
            // return the human difference
            return $this->first_entry_date->diffForHumans($newenddate, \Carbon\CarbonInterface::DIFF_ABSOLUTE);
        }
    }

    public function amountAsCurrency($symbol = '')
    {
        return number_format(($this->amount / 100), 2) . $symbol;
    }
}
