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
        Schema::create('salary_scales', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->boolean('active')->default(true);
            $table->double('base_salary');
            $table->foreignId('regime_level_grade_id');
            $table->foreignId('salary_scale_decree_id');
            $table->foreignId('user_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_scales');
    }
};
