<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMensaje;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactanosController extends Controller
{
    public function index()
    {
        return view('contactanos');
    }

    public function enviar(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:150'],
            'message' => ['required', 'string', 'max:2000'],
        ], [
            'name.required'    => 'Cuéntanos cómo te llamas.',
            'email.required'   => 'Necesitamos tu correo para responderte.',
            'email.email'      => 'Ese correo no parece válido.',
            'message.required' => 'Escribe tu mensaje antes de enviarlo.',
            'message.max'      => 'Tu mensaje es un poco largo, intenta resumirlo (máx. 2000 caracteres).',
        ]);

        // Correo de destino: la casilla del sitio (configúrala en .env con MAIL_TO_ADDRESS).
        $destino = env('MAIL_TO_ADDRESS', config('mail.from.address'));

        Mail::to($destino)->send(new ContactoMensaje($datos));

        return back()->with('contacto_ok', '¡Gracias! Tu mensaje voló directo a las nubes de Nebulita 💜');
    }
}
