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
        Schema::create('attendances', function(Blueprint $table) {
           $table->id("attendanceId");
           $table->unsignedBigInteger("studentId");
           $table->unsignedBigInteger("courseId");
           $table->string("attendanceDate");
           $table->string("attendanceStatus");
           $table->foreign("studentId")->references("studentId")->on("students")->onDelete("cascade");
           $table->foreign("courseId")->references("courseId")->on("courses")->onDelete("cascade");
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
