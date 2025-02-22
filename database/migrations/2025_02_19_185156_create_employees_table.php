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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('original_id')->nullable()->unique();
            $table->string('email')->unique();
            $table->string('ssn');
            $table->string('phone');
            $table->string('firstname');
            $table->string('lastname');
            $table->date('dob');
            $table->integer('salary');
            $table->date('employment_from');
            $table->date('employment_to')->nullable();
            $table->timestamps();

            $table->index('employment_from');
            $table->index('employment_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
