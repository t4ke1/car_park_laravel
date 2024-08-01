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
        Schema::table('cars', function (Blueprint $table) {
            $table->foreign('driver_id')->references('id')->on('drivers');
        });

        Schema::table('drivers', function (Blueprint $table) {
            $table->foreign('car_id')->references('id')->on('cars');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('job_titles');
        });

        Schema::table('car_job_titles', function (Blueprint $table) {
            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('job_title_id')->references('id')->on('job_titles');
        });

        Schema::table('drive_times', function (Blueprint $table) {
            $table->foreign('car_id')->references('id')->on('cars');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drive_times', function (Blueprint $table) {
            $table->dropForeign(['car_id']);
        });

        Schema::table('car_job_titles', function (Blueprint $table) {
            $table->dropForeign(['car_id']);
            $table->dropForeign(['job_title_id']);
        });

        Schema::table('job_titles', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
        });

        Schema::table('drivers', function (Blueprint $table) {
            $table->dropForeign(['car_id']);
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign(['driver_id']);
        });
    }
};
