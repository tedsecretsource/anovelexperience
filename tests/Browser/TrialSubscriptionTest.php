<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use PHPUnit\Framework\Assert;

class TrialSubscriptionTest extends DuskTestCase
{
    /**
     * Trial subscriptions work, do not go through paypal
     *
     * @return void
     */
    public function testTrialSubscription()
    {
        $this->browse(function (Browser $browser) {
            // as an authenticated user
            $user = factory(App\User::class)->create();
            $novel = factory(App\Novel::class)->create();;
            // Go to novel subscription screen http://dracula.test/epistolary-novels/7/subscribe
            // select Trial from dropdown
            // leave pace as is
            // submit
            // should see Congratulations. You are now subscribed to
            // should see Settings for
            $browser->loginAs($user, 'web');
            $browser->visit(route('novel.subscribe', ['id' => $novel->id]))
                ->screenshot('subscription_page')
                ->radio('type', 'trial')
                ->click('#trial-submit-button')
                ->assertSee('Congratulations. You are now subscribed to')
                ->assertSee('Settings for');

            // $user->subscriptions should have the selected novel
            $this->assertTrue($user->isSubscribed($novel->id));
            // standard log should contain subscription confirmation email, or a job should be in the jobs table
            // activity_log should contain "New subscription for" with causer_id == user_id
        });
    }
}
