<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Password;
use App\Models\User;
class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $userEmail = '';
    private $token;
    /**
     * Create a new message instance.
     */
    public function __construct($email,$token)
    {
        $this->userEmail = $email;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to:$this->userEmail,
            subject: 'Welcome Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
      
            return new Content(
                view: 'Email.welcome-mail',
            );
    }
    
    public function build()
    {
        return $this->subject('Welcome Email')
                    ->view('Email.welcome-mail')
                    ->with([
                        'token' => $this->token
                    ]);
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
