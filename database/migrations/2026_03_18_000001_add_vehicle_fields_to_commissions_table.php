<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('commissions', function (Blueprint $table) {
            if (!Schema::hasColumn('commissions', 'vehicle_plate')) {
                $table->string('vehicle_plate')->nullable()->after('expense_value');
            }

            if (!Schema::hasColumn('commissions', 'driver_name')) {
                $table->string('driver_name')->nullable()->after('vehicle_plate');
            }
        });
    }

    public function down(): void
    {
        Schema::table('commissions', function (Blueprint $table) {
            $columns = [];

            if (Schema::hasColumn('commissions', 'vehicle_plate')) {
                $columns[] = 'vehicle_plate';
            }

            if (Schema::hasColumn('commissions', 'driver_name')) {
                $columns[] = 'driver_name';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};