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

class DiagnosticoIshiharaPdfMail extends Mailable
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
            subject: 'Tu resultado del test de Ishihara — Nebula View — ' . $this->test->fecha_realizacion->format('d/m/Y'),
        );
    }

    public function content(): Content
    {
        $r = $this->test->resultado ?? [];

        return new Content(
            markdown: 'emails.diagnostico-ishihara-pdf',
            with: [
                'usuario'  => $this->usuario,
                'test'     => $this->test,
                'aciertos' => $r['aciertos'] ?? 0,
                'total'    => $r['total_laminas'] ?? 0,
            ],
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfBinario, 'test-ishihara-nebula-view.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
