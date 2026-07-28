<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            // 'preset' = usa avatar_preset (galería), 'custom' = usa avatar_custom (foto subida)
            $table->string('avatar_tipo', 10)->default('preset')->after('rol');
            $table->string('avatar_preset', 40)->nullable()->after('avatar_tipo');
            $table->string('avatar_custom', 255)->nullable()->after('avatar_preset');
            $table->string('marco_perfil', 40)->default('ninguno')->after('avatar_custom');
            $table->string('banner_perfil', 40)->default('nebula')->after('marco_perfil');
        });
    }

    public function down(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropColumn(['avatar_tipo', 'avatar_preset', 'avatar_custom', 'marco_perfil', 'banner_perfil']);
        });
    }
};
