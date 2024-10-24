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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->date('date_birth');
            $table->string('student_number')->unique();
            $table->string('telephone_number');
            $table->string('personal_email');
            $table->string('unistra_email');
            $table->string('address');
            $table->string('postcode');
            $table->string('city');
            $table->string('permanent_telephone_number')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('permanent_postcode')->nullable();
            $table->string('permanent_city')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
