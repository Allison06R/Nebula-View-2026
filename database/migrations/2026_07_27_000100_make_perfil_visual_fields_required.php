<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Rellena filas antiguas que pudieran tener estos campos vacíos,
        // para poder aplicar el NOT NULL sin romper datos existentes.
        DB::table('perfil_visual')->whereNull('problema_visual')->update(['problema_visual' => 'No lo sé']);
        DB::table('perfil_visual')->whereNull('sintomas')->update(['sintomas' => 'Ninguno']);
        DB::table('perfil_visual')->whereNull('color')->update(['color' => 'Negro']);
        DB::table('perfil_visual')->whereNull('estetica')->update(['estetica' => 'Clásico']);

        Schema::table('perfil_visual', function (Blueprint $table) {
            $table->string('problema_visual', 100)->nullable(false)->change();
            $table->text('sintomas')->nullable(false)->change();
            $table->string('color', 50)->nullable(false)->change();
            $table->string('estetica', 100)->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('perfil_visual', function (Blueprint $table) {
            $table->string('problema_visual', 100)->nullable()->change();
            $table->text('sintomas')->nullable()->change();
            $table->string('color', 50)->nullable()->change();
            $table->string('estetica', 100)->nullable()->change();
        });
    }
};
