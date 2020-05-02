<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Entry;
use App\Traits\Fonts;

class StandardEntry extends Mailable
{
    use Queueable, SerializesModels, Fonts;

    public $user, $entry;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Entry $entry)
    {
        $this->user = $user;
        $this->entry = $entry;
        $this->theme = $entry->font;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->entry->title == '' ? '' : ': ' . $this->entry->title;
        return $this->markdown('emails.standard-entry')
            ->subject($this->entry->novel->novel_emoji . ' ' . $this->entry->novel->title . $subject)
            ->with([
                'theme' => $this->theme,
                'font_url' => $this->get_font_url($this->theme)
            ]);
    }
}
