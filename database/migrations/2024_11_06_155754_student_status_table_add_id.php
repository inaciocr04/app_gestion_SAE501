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
        Schema::table('student_status', function (Blueprint $table) {
            $table->dropPrimary(['statut_id', 'student_id', 'actual_year_id', 'year_training_id', 'start_date_status']);
            $table->bigInteger('id')->unsigned()->primary();
            $table->bigInteger('id')->unsigned()->primary()->autoIncrement()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_status', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->primary(false)->autoIncrement(false)->change();
            $table->dropPrimary(['id']);
            $table->dropColumn('id');
            $table->primary(['statut_id', 'student_id', 'actual_year_id', 'year_training_id', 'start_date_status']);
        });
    }
};