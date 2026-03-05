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
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->text('objetive');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('abroad');
            $table->text('destination');
            $table->double('training_expenses')->nullable();
            $table->foreignId('budget_id')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('commission_status_id');
            $table->foreignId('dependency_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
