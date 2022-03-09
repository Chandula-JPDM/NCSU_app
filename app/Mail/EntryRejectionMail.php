<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class EntryRejectionMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $feedback;
    protected $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $name, String $user, array $feedback)
    {
        $this->user = $user;
        $this->feedback = $feedback;
        $this->name = $name;
        //dd($feedback);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$url = URL::temporarySignedRoute('forum.verification',now()->addMinutes(5), ['username' => ($this->user)]);
        $url = URL::signedRoute('forum.resubmit', ['username' => ($this->user)]);
        return $this->markdown('mail.entry-rejection-mail', ['url' => $url, 'feedback' => ($this->feedback), 'name' => ($this->name)]);

    }
}
