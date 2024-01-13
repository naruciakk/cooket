<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GuestRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $pin;
    public $sha;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event, $pin, $sha)
    {
        $this->event = $event;
        $this->pin = $pin;
        $this->sha = $sha;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('APP_EMAIL'), env('APP_NAME'))
                    ->replyTo($this->event->contact, $this->event->name)
                    ->view('mail.guest', compact('event'), compact('pin'), compact('sha'));
    }
}
