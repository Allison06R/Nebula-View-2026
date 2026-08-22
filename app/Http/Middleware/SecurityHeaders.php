<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        // Solo se envía por HTTPS; en HTTP el navegador la ignora igual.
        $response->headers->set(
            'Strict-Transport-Security',
            'max-age=31536000; includeSubDomains'
        );

        // Ajustado a los recursos externos reales que usa el sitio:
        // unpkg (model-viewer), cdnjs (gsap), jsdelivr (three.js / mediapipe),
        // storage.googleapis.com (modelos de mediapipe), sketchfab (iframe 3D).
        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'self'; "
            . "script-src 'self' 'unsafe-inline' 'wasm-unsafe-eval' https://unpkg.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; "
            . "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; "
            . "font-src 'self' https://fonts.gstatic.com; "
            . "img-src 'self' data: https:; "
            . "connect-src 'self' https://api.groq.com https://translation.googleapis.com https://storage.googleapis.com https://cdn.jsdelivr.net; "
            . "frame-src https://sketchfab.com; "
            . "frame-ancestors 'none';"
        );

        return $response;
    }
}
