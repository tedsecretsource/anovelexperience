<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class SubscriptionTypeTableSeeder extends Seeder
{
    public function run()
    {
        App\SubscriptionType::create(
            ['type' => 'full']
        );
        App\SubscriptionType::create(
            ['type' => 'gift']
        );
        App\SubscriptionType::create(
            ['type' => 'trial']
        );
    }
}
