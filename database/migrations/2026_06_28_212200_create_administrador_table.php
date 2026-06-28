<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->string('usuario', 50)->unique();
            $table->string('correo', 100)->unique();
            $table->string('contrasena', 255);
            $table->string('nombre', 100);
            $table->string('rol', 20)->default('usuario');
            $table->dateTime('sesion')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('usuario');
    }
};