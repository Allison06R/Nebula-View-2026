<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('perfil_visual', function (Blueprint $table) {
            $table->id('id_perfil_visual');
            $table->unsignedBigInteger('id_usuario');
            $table->string('tipo_cara', 50)->nullable();
            $table->integer('edad')->nullable();
            $table->string('sexo', 20)->nullable();
            $table->string('problema_visual', 100)->nullable();
            $table->text('sintomas')->nullable();
            $table->string('color', 50)->nullable();
            $table->string('estetica', 100)->nullable();
            $table->timestamps();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('perfil_visual');
    }
};