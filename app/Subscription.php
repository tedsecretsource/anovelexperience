<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subscription extends Model
{
    use CrudTrait;

    protected $appends = [
        'delivery_is_past_due'
    ];

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

    protected $dates = [
        'entry_date'
    ];

    public function subscriber()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function novel()
    {
        return $this->belongsTo(Novel::class);
    }

    public function scopeActiveOrPausedSubscriptions($query)
    {
        return $query->where('status', 'active')->orWhere('status', 'paused');
    }

    public function logs()
    {
        return $this->hasMany(SentLog::class);
    }

    public function getEntryDateAttribute($value)
    {
        return $value;
    }

    public function getNextEntryDeliveryDateAttribute()
    {
        $log = $this->logs()->orderBy('id', 'desc')->take(1)->first();
        // get the most recent and next entry dates
        if (is_object($log) and $log->count() > 0) {
            $most_recent_entry = Entry::find($log->entry_id);
        } else {
            $most_recent_entry = $this->novel->entries->first();
        }

        $next_entry = Entry::where('novel_id', $this->novel_id)
            ->where('entry_date', '>', $most_recent_entry->entry_date)
            ->orderBy('entry_date')
            ->first();
        if (is_object($next_entry) and $next_entry->count() > 0) {
            // divide by the pace
            $paced_seconds = $most_recent_entry->entry_date->diffInSeconds($next_entry->entry_date) / $this->pace;
            // add the result to the most recent entry date
            $next_due_date = $most_recent_entry->created_at->copy()->addSeconds(round($paced_seconds));
        } else {
            // we're past the end of the novel
            $next_due_date = $most_recent_entry->entry_date;
        }
        // return as a date
        return $next_due_date;
    }

    public function getDeliveryIsPastDueAttribute()
    {
        if ($this->next_entry_delivery_date < Carbon::now()) {
            return true;
        }
        return false;
    }
}
