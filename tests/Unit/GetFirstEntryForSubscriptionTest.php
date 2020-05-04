<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class GetFirstEntryForSubscriptionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testFirstEntryAlgorithm()
    {
        // create a user
        $user = factory(\App\User::class)->create();
        // pick a novel
        $novel = \App\Novel::all()->random();
        // subscribe
        $sub = \App\Subscription::create(
            [
                'user_id' => $user->id,
                'novel_id' => $novel->id,
                'subscribed' => now(),
                'type' => 'full',
                'status' => 'active',
                'first_entry_date' => now(),
                'pace' => 1
            ]
        );
        $firstEntryFromNovel = $novel->entries()->orderBy('entry_date')->first();
        $nextEntryFromSub = $sub->getNextEntry();

        $this->assertTrue($firstEntryFromNovel->id == $nextEntryFromSub->id);
        // add an entry with an earlier date than the first and test again
        $new_entry = factory(\App\Entry::class)->create(
            [
                'novel_id' => $novel->id,
                'entry_date' => $firstEntryFromNovel->entry_date->subDay()
            ]
        );
        $firstEntryFromNovel = $novel->entries()->orderBy('entry_date')->first();
        $nextEntryFromSub = $sub->getNextEntry();

        $this->assertTrue($firstEntryFromNovel->id == $nextEntryFromSub->id);
    }

    // if we've delivered the last entry, delivery_is_past_due should be false
    public function testLastEntryNotDelieverdTwice()
    {
        // create a user
        $user = factory(\App\User::class)->create();
        // pick a novel
        $novel = \App\Novel::all()->random();
        // subscribe
        $sub = \App\Subscription::create(
            [
                'user_id' => $user->id,
                'novel_id' => $novel->id,
                'subscribed' => now(),
                'type' => 'full',
                'status' => 'active',
                'first_entry_date' => now(),
                'pace' => 1
            ]
        );
        $last_entry = $novel->entries()->orderBy('entry_date', 'desc')->first();
        // add sent_log for the last entry
        factory(\App\SentLog::class)->create(
            [
                'novel_id' => $novel->id,
                'subscription_id' => $sub->id,
                'user_id' => $user->id,
                'entry_id' => $last_entry->id
            ]
        );

        $this->assertTrue(false == $sub->delivery_is_past_due);
    }
}
