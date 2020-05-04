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
        'first_entry_date'
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

    /**
     * Returns the pace-adjusted next entry delivery date
     *
     * @return object A Carbon date object consisting of the pace-adjusted next delivery date or null if we're at the end of the book
     */
    public function getNextEntryDeliveryDateAttribute()
    {
        $next_entry = $this->getNextEntry();
        if (null == $next_entry) {
            // I could return a ficticious date in the future but that seems wrong
            return null;
        }

        $most_recent_entry = $this->getMostRecentEntry();
        if (null == $most_recent_entry) {
            // if the sub->first_entry_date is in the past or equal to now,
            // don't have a cow, just use this date because
            return $this->created_at;
        }

        $most_recent_entry_date = $most_recent_entry->entry_date;

        // divide by the pace
        $paced_seconds = $most_recent_entry_date->diffInSeconds($next_entry->entry_date) / $this->pace;
        // add the result to the most recent entry date
        $next_due_date = $most_recent_entry_date->copy()->addSeconds(round($paced_seconds));

        // return as a date
        return $next_due_date;
    }

    public function getDeliveryIsPastDueAttribute()
    {
        if (null == $this->next_entry_delivery_date) {
            return false;
        }
        return $this->next_entry_delivery_date < Carbon::now();
    }

    /**
     * Get the next entry in the queue
     *
     * @return object Carbon object if an entry exists, null otherwise
     */
    public function getNextEntry()
    {
        $most_recent_entry = $this->getMostRecentEntry();
        if (null == $most_recent_entry) {
            $next_entry = $this->novel->entries()->orderBy('entry_date')->first();
        } else {
            $next_entry = Entry::where('novel_id', $this->novel_id)
                ->where('entry_date', '>', $most_recent_entry->entry_date)
                ->orderBy('entry_date')
                ->first();
        }

        return $next_entry;
    }

    /**
     * Get the most recently sent entry, or null if none have been sent
     *
     * @return object Carbon date object if an entry has been sent, null otherwise
     */
    public function getMostRecentEntry()
    {
        $log = $this->logs()->orderBy('id', 'desc')->take(1)->first();
        // get the most recent and next entry dates
        if (is_object($log) and $log->count() > 0) {
            $most_recent_entry = Entry::find($log->entry_id);
        } else {
            $most_recent_entry = null;
        }
        return $most_recent_entry;
    }

    public static function subscriptionsPendingDelivery()
    {
        return array_filter(Subscription::where('status', 'active')->get()->toArray(), function ($item) {
            return (bool) $item['delivery_is_past_due'];
        });
    }
}
