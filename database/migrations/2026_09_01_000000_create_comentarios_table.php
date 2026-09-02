<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id('id_comentario');
            $table->unsignedBigInteger('id_usuario');
            $table->string('pagina', 50);
            $table->text('contenido');
            // aprobado: visible públicamente.
            // rechazado: la IA lo marcó como ofensivo, no se muestra.
            // pendiente_revision: la IA no pudo evaluarlo (falla/timeout), un admin decide.
            $table->enum('estado', ['aprobado', 'rechazado', 'pendiente_revision'])
                  ->default('pendiente_revision');
            $table->text('motivo_rechazo')->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
            $table->index(['pagina', 'estado']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
