<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class SubscriptionStatusTableSeeder extends Seeder
{
    public function run()
    {
        App\SubscriptionStatus::create(
            ['status' => 'active']
        );
        App\SubscriptionStatus::create(
            ['status' => 'canceled']
        );
        App\SubscriptionStatus::create(
            ['status' => 'fulfilled']
        );
        App\SubscriptionStatus::create(
            ['status' => 'paused']
        );
    }
}
