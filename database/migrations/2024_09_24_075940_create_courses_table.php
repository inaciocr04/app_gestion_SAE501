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
        Schema::create('courses', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained();
            $table->foreignId('training_courses_id')->constrained();
            $table->foreignId('year_training_id')->constrained();
            $table->foreignId('group_td_id');
            $table->foreignId('group_tp_id');
            $table->dateTime('start_date');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
