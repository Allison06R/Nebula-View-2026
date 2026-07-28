<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            // 'preset' = usa banner_perfil (galería), 'custom' = usa banner_custom (foto subida).
            // Misma lógica que ya existe para el avatar.
            $table->string('banner_tipo', 10)->default('preset')->after('banner_perfil');
            $table->string('banner_custom', 255)->nullable()->after('banner_tipo');
        });

        // El catálogo de apariencia (config/apariencia.php) cambió de nombres
        // descriptivos ("nebulosa", "nebula", etc.) a claves de archivo
        // ("avatar-1", "banner-1", etc.). Reasignamos los valores viejos que
        // hayan quedado guardados para que sigan mostrando algo válido.
        $avatarMap = [
            'nebulosa' => 'avatar-1', 'eclipse' => 'avatar-2', 'aurora' => 'avatar-3',
            'cometa'   => 'avatar-4', 'iris'     => 'avatar-5', 'prisma'  => 'avatar-6',
            'lavanda'  => 'avatar-7', 'coral'    => 'avatar-8',
        ];
        $bannerMap = [
            'nebula'  => 'banner-1', 'medianoche' => 'banner-2', 'atardecer' => 'banner-3',
            'oceano'  => 'banner-4', 'bosque'     => 'banner-5', 'polvo'     => 'banner-6',
        ];

        foreach ($avatarMap as $viejo => $nuevo) {
            DB::table('usuario')->where('avatar_preset', $viejo)->update(['avatar_preset' => $nuevo]);
        }
        foreach ($bannerMap as $viejo => $nuevo) {
            DB::table('usuario')->where('banner_perfil', $viejo)->update(['banner_perfil' => $nuevo]);
        }

        // Cualquier usuario sin preset válido (nulo o vacío) cae en el primero del catálogo.
        DB::table('usuario')->whereNull('avatar_preset')->orWhere('avatar_preset', '')
            ->update(['avatar_preset' => 'avatar-1']);
        DB::table('usuario')->whereNull('banner_perfil')->orWhere('banner_perfil', '')
            ->update(['banner_perfil' => 'banner-1']);
    }

    public function down(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropColumn(['banner_tipo', 'banner_custom']);
        });
    }
};