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
    }
}
