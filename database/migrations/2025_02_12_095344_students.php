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
        Schema::create('students', function (Blueprint $table){
            $table->id("studentId");
            $table->string("firstName");
            $table->string("lastName");
            $table->string("gender");
            $table->string("dateOfBirth");
            $table->string("contactNumber");
            $table->string("email");
            $table->string("address");
            $table->string("enrollmentDate");
            $table->unsignedBigInteger("userId");
            $table->foreign("userId")->references("userId")->on("users")->onDelete("cascade");
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
