<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Novel;
use App\Traits\Fonts;

class GiftSubscriptionInvite extends Mailable
{
    use Queueable, SerializesModels, Fonts;

    public $to_user, $giver_user, $novel;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $to_user, User $giver_user, Novel $novel)
    {
        $this->to_user = $to_user;
        $this->giver_user = $giver_user;
        $this->novel = $novel;
        $this->theme = 'serif';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.gift-subscription-invite')
            ->subject("Gift Subscription to {{ $this->novel->title }}")
            ->with([
                'theme' => $this->theme,
                'font_url' => $this->get_font_url('serif')
            ]);
    }
}
