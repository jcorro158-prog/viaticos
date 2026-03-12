<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('commissions', function (Blueprint $col) {
            // Guardará la ruta de la invitación (PDF/Imagen)
            $col->string('invitation_path')->nullable()->after('description');
            
            // Guardará la ruta de la evidencia final
            $col->string('evidence_path')->nullable()->after('invitation_path');
        });
    }

    public function down(): void
    {
        Schema::table('commissions', function (Blueprint $col) {
            $col->dropColumn(['invitation_path', 'evidence_path']);
        });
    }
};