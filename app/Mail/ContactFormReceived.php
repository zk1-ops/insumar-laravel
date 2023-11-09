<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $data)
    {
        // No es necesario asignar las propiedades aquí, se manejan automáticamente con las propiedades públicas
    }

    public function build()
    {
        return $this->subject('Mensaje enviado desde formulario')
                    ->view('email_contact')
                    ->with(['data' => $this->data]);
    }

    public function attachments(): array
    {
        return [];
    }
}
