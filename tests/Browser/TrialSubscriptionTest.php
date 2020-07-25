<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use PHPUnit\Framework\Assert;

class TrialSubscriptionTest extends DuskTestCase
{
    public $subscriber = null;
    public $novel = null;

    public function setUp(): void
    {
        parent::setUp();
        $this->subscriber = factory(\App\User::class)->create();
        $this->novel = factory(\App\Novel::class)->create();
    }

    public function tearDown(): void
    {
        $this->subscriber->delete();
        $this->novel->delete();
        parent::tearDown();
    }

    /**
     * Trial subscriptions work, do not go through paypal
     *
     * @return void
     */
    public function testTrialSubscription()
    {
        $this->browse(function (Browser $browser) {
            // as an authenticated this->subscriber
            // Go to novel subscription screen http://dracula.test/epistolary-novels/7/subscribe
            // select Trial from dropdown
            // leave pace as is
            // submit
            // should see Congratulations. You are now subscribed to
            // should see Settings for
            $browser->loginAs($this->subscriber, 'web');
            $browser->visit(route('novel.subscribe', ['id' => $this->novel->id]))
                ->radio('type', 'trial')
                ->screenshot('subscription_page')
                ->click('#trial-submit-button')
                ->assertSee('Congratulations. You are now subscribed to')
                ->assertSee('Settings for');

            // $this->subscriber->subscriptions should have the selected novel
            $this->assertTrue($this->subscriber->isSubscribed($this->novel->id));
            // a job should be in the jobs table with the welcome message
            // {"uuid":"e7710ca8-99dd-4923-8169-cf32fc870950","displayName":"App\\Jobs\\SendWelcomeMessage","job":"Illuminate\\Queue\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\Jobs\\SendWelcomeMessage","command":"O:27:\"App\\Jobs\\SendWelcomeMessage\":9:{s:4:\"user\";O:45:\"Illuminate\\Contracts\\Database\\ModelIdentifier\":4:{s:5:\"class\";s:8:\"App\\User\";s:2:\"id\";i:252;s:9:\"relations\";a:0:{}s:10:\"connection\";s:5:\"mysql\";}s:3:\"job\";N;s:10:\"connection\";N;s:5:\"queue\";N;s:15:\"chainConnection\";N;s:10:\"chainQueue\";N;s:5:\"delay\";N;s:10:\"middleware\";a:0:{}s:7:\"chained\";a:0:{}}"}}
            // activity_log should contain "New subscription for" with causer_id == user_id
        });
    }
}
