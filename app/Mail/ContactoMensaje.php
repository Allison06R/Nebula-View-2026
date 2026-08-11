<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactoMensaje extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Datos del formulario de contacto.
     *
     * @var array<string,string>
     */
    public array $datos;

    public function __construct(array $datos)
    {
        $this->datos = $datos;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            // El correo llega a la bandeja del sitio, pero se puede
            // responder directo al usuario gracias al replyTo.
            replyTo: [$this->datos['email']],
            subject: 'Nuevo mensaje de contacto — ' . $this->datos['name'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contacto',
            with: ['datos' => $this->datos],
        );
    }
}
