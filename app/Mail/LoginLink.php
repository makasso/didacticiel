<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class LoginLink extends Mailable
{
    use Queueable, SerializesModels;

    public $plainTextToken;
    public $expiresAt;

    /**
     * Create a new message instance.
     */
    public function __construct($plainTextToken, $expiresAt)
    {
        $this->plainTextToken = $plainTextToken;
        $this->expiresAt = $expiresAt;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Lien de connexion',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
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

    public function build()
    {
        return $this->subject(
            config('app.name') . ' Vérification de connexion'
        )->markdown('emails.login-link', [
            'url' => URL::temporarySignedRoute('verify-login', $this->expiresAt, [
                'token' => $this->plainTextToken,
            ]),
        ]);
    }
}
