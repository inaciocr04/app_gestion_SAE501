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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_department')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_postcode')->nullable();
            $table->string('company_city')->nullable();
            $table->string('company_country')->nullable();
            $table->string('company_manager_civility')->nullable();
            $table->string('company_manager_firstname')->nullable();
            $table->string('company_manager_lastname')->nullable();
            $table->string('company_manager_tel_number')->nullable();
            $table->string('company_manager_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
