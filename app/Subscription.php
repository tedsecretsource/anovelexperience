<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Subscription extends Model
{
    use CrudTrait;
    use SoftDeletes;

    protected $appends = [
        'delivery_is_past_due',
        'next_entry_delivery_date'
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
     * Method for calculating the next "normalized" send date is:
     *
     * 1. Find the difference between the previous entry and the current entry in seconds
     * 2. Divide that by the pace
     * 3. Add the seconds to the most recent log entry
     *
     * @return object A Carbon date object consisting of the pace-adjusted next delivery date or null if we're at the end of the book
     */
    public function getNextEntryDeliveryDateAttribute()
    {
        $next_entry = $this->getNextEntry();
        if (null == $next_entry) {
            // The last entry has already been sent
            // I could return a ficticious date in the future but that seems wrong
            return null;
        }

        $most_recent_entry = $this->getMostRecentEntry();
        if (null == $most_recent_entry) {
            // if the sub->first_entry_date is in the past or equal to now,
            // don't have a cow, just use this date because none have been sent yet
            // and this date is in the past, so the first email will be generated
            return $this->created_at;
        }

        $most_recent_entry_date = $most_recent_entry->entry_date;
        \Log::info($most_recent_entry_date);
        \Log::info($next_entry->entry_date);

        // divide by the pace
        $paced_seconds = $most_recent_entry_date->diffInSeconds($next_entry->entry_date) / $this->pace;
        \Log::info($this->pace);
        \Log::info($paced_seconds);

        // add the result to the most recent log date
        // This is the line that MAKES THE MAGIC HAPPEN!
        $log = $this->logs()->where('user_id', $this->user_id)->orderBy('id', 'desc')->first();
        \Log::info($log);
        $next_due_date = $log->created_at->copy()->addSeconds(round($paced_seconds));
        \Log::info($next_due_date);

        // return as a date
        return $next_due_date;
    }

    /**
     * Returns true if an entry is past due for delivery, false otherwise
     *
     * @return boolean
     */
    public function getDeliveryIsPastDueAttribute()
    {
        if (null == $this->next_entry_delivery_date) {
            return false;
        }
        // we need to conform the year part of the date or these calculations will be completely wrong
        /**
         * Given an entry_date of 1990-02-20
         * And a novel that starts on 1990-06-20
         * And ends on 2021-03-17
         * And today's date is 2020-05-04
         * When I check delivery_is_past_due
         * Then the answer depends on whether or not the prior issue has been sent
         *
         * Examples:
         *  - Novel starts in 2015 and ends in 2025, it is currently 2020
         */
        return $this->next_entry_delivery_date < now();
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
            $next_entry = $this->novel->entries()
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
        return collect(array_filter(Subscription::where('status', 'active')->get()->toArray(), function ($item) {
            return (bool) $item['delivery_is_past_due'];
        }));
    }
}
