<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tests', function (Blueprint $table) {
            $table->id('id_test');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->text('resultado')->nullable();
            $table->dateTime('fecha_realizacion')->nullable();
            $table->timestamps();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('tests');
    }
};