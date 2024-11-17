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
        Schema::create('depots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actual_year_id')->constrained()->cascadeOnDelete();
            $table->foreignId('year_training_id')->constrained()->cascadeOnDelete();
            $table->string('depot_link');
            $table->boolean('actif')->default(false);
            $table->date('end_date_depot')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depots');
    }
};
