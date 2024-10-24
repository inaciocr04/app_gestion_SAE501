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
        Schema::create('trainings', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('year_training_id')->constrained()->cascadeOnDelete()->cascadeOnDelete();
            $table->foreignId('actual_year_id')->constrained()->cascadeOnDelete()->cascadeOnDelete();
            $table->timestamps();

            $table->primary(['student_id', 'year_training_id', 'actual_year_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
