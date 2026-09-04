<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Guarda el historial de conversaciones con el asistente Nebulita para que
// cada usuario pueda verlo en su perfil ("Chats con Nebulita"). El widget es
// público (no requiere sesión), así que id_usuario es nullable: solo se
// rellena cuando el mensaje lo envió alguien con sesión iniciada.
return new class extends Migration {
    public function up(): void
    {
        Schema::create('chat_mensajes', function (Blueprint $table) {
            $table->id('id_chat_mensaje');
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->text('mensaje_usuario');
            $table->text('respuesta_bot');
            $table->timestamps();

            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
            $table->index(['id_usuario', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_mensajes');
    }
};
