<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('modelos_3d', function (Blueprint $table) {
            $table->id('id_modelo3d');
            $table->unsignedBigInteger('id_usuario');
            $table->string('nombre', 100);
            $table->string('categoria', 50)->nullable();
            $table->tinyInteger('favorito')->default(0);
            $table->timestamps();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('modelos_3d');
    }
};