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
    Schema::table('commissions', function (Blueprint $table) {
        // Esto arregla el error "Unknown column 'description'"
        if (!Schema::hasColumn('commissions', 'description')) {
            $table->text('description')->nullable()->after('destination');
        }

        // Esto arregla los errores de "doesn't have a default value"
        $table->boolean('abroad')->default(0)->change();
        $table->text('objetive')->nullable()->change();
        $table->foreignId('user_id')->nullable()->change();
        $table->foreignId('commission_status_id')->nullable()->change();
    });
    }
};
