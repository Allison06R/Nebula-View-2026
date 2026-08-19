<?php

namespace App\Mail;

use App\Models\Test;
use App\Models\Usuario;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class DiagnosticoPdfMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Usuario $usuario,
        public Test $test,
        public string $pdfBinario,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu diagnóstico Nebula View — ' . $this->test->fecha_realizacion->format('d/m/Y'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.diagnostico-pdf',
            with: [
                'usuario' => $this->usuario,
                'test'    => $this->test,
                'titulo'  => $this->test->resultado['resultadoIA']['titulo'] ?? 'Diagnóstico visual',
            ],
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfBinario, 'diagnostico-nebula-view.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
