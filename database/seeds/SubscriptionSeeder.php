<?php

use Illuminate\Database\Seeder;
use App\Subscription;

class SubscriptionTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\User::class, 30)
            ->create()
            ->each(
                function ($user) {
                    $user->subscriptions()->save(factory(Subscription::class)->make([
                        'user_id' => $user->id,
                        'novel_id' => App\Novel::all()->random()->id
                    ]));
                }
            );
    }
}
