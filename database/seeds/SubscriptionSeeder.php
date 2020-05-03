<?php

use Illuminate\Database\Seeder;
use App\Subscription;

class SubscriptionTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\User::class, 200)
            ->create()
            ->each(
                function ($user) {
                    $user->subscriptions()->save(
                        factory(Subscription::class)->make([
                            'user_id' => $user->id,
                            'novel_id' => App\Novel::all()->random()->id
                        ])
                    );

                    $entries = App\Entry::where('novel_id', $user->subscriptions->first()->novel_id)->orderBy('entry_date')->get();
                    $max = rand(0, $entries->count());
                    for ($i = 0; $i < $max; $i++) {
                        $user->subscriptions->first()->logs()->save(
                            factory(App\SentLog::class)->make([
                                'subscription_id' => $user->subscriptions->first()->id,
                                'user_id' => $user->id,
                                'entry_id' => $entries[$i]->id
                            ])
                        );
                    }
                }
            );
    }
}
