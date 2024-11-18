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
        Schema::create('student_status', function (Blueprint $table) {
            $table->foreignId('tutor_id')->nullable();
            $table->foreignId('teacher_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('statut_id');
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('actual_year_id');
            $table->foreignId('year_training_id');
            $table->foreignId('company_id')->nullable();
            $table->string('status_company') ->nullable();
            $table->dateTime('start_date_status')->nullable();
            $table->dateTime('end_date_status')->nullable();
            $table->dateTime('start_date_company')->nullable();
            $table->dateTime('end_date_company')->nullable();
            $table->timestamps();

            $table->primary(['statut_id', 'student_id','actual_year_id','year_training_id','start_date_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_status');
    }
};
