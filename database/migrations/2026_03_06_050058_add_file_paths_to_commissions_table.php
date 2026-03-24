<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('commissions', function (Blueprint $col) {
            $col->string('invitation_path')->nullable()->after('training_expenses');
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