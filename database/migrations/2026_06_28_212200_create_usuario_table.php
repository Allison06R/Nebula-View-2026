<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario');                 // PK autoincremental
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->string('usuario', 50)->unique();
            $table->string('correo', 150)->unique();
            $table->string('contrasena', 255);
            $table->string('nombre', 100);
            $table->string('apellido', 100)->nullable();
            $table->string('rol', 30)->default('usuario');
            $table->boolean('sesion')->default(false);
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
 