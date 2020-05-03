<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Entry;
use App\Subscription;
use App\User;
use Mail;

class SendEntries implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     * 26 => [
     *   "id" => 82,
     *   "user_id" => 85,
     *   "novel_id" => 6,
     *   "subscribed" => "1977-06-16 15:52:19",
     *   "type" => "trial",
     *   "status" => "active",
     *   "payment_confirmation_id" => null,
     *   "payment_date" => null,
     *   "payment_amount" => null,
     *   "payment_status" => null,
     *   "first_entry_date" => "2014-04-06 09:40:30",
     *   "pace" => 4.0,
     *   "hash" => null,
     *   "created_at" => "2020-05-02T23:26:27.000000Z",
     *   "updated_at" => "2020-05-02T23:26:27.000000Z",
     *   "deleted_at" => null,
     *   "delivery_is_past_due" => true,
     * ],
     * @return void
     */
    public function handle()
    {
        $subscriptions_to_fill = array_filter(Subscription::where('status', 'active')->get()->toArray(), function ($item) {
            return (bool) $item['delivery_is_past_due'];
        });

        foreach ($subscriptions_to_fill as $sub) {
            $user = User::find($sub['user_id']);
            $subObj = Subscription::find($sub['id']);
            $entryObj = $subObj->getNextEntry();
            $email = new \App\Mail\StandardEntry($user, $entryObj);
            Mail::to($user->email)->send($email);
            \App\SentLog::create(
                [
                    'subscription_id' => $entryObj->id,
                    'novel_id' => $entryObj->novel_id,
                    'user_id' => $sub['user_id']
                ]
            );
        }
    }
}
