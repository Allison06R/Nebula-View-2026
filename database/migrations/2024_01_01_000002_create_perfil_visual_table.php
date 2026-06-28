<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perfil_visual', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->integer('edad')->nullable();
            $table->string('sexo', 20)->nullable();
            $table->string('ocupacion', 100)->nullable();
            $table->string('cara', 50)->nullable();
            $table->string('sintomas', 100)->nullable();
            $table->string('frecuencia', 50)->nullable();
            $table->string('desde_tiempo', 50)->nullable();
            $table->string('problema', 100)->nullable();
            $table->string('lentes', 10)->nullable();
            $table->string('revision', 50)->nullable();
            $table->string('pantalla', 10)->nullable();
            $table->string('dispositivos', 100)->nullable();
            $table->string('regla', 10)->nullable();
            $table->string('uv', 10)->nullable();
            $table->string('sueno', 10)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfil_visual');
    }
};
