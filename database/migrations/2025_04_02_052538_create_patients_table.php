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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birth_day');
            $table->string('gender');
            $table->string('medical_card');
            $table->string('passport')->nullable();
            $table->string('nationality')->nullable();
            $table->string('address')->nullable();
            $table->string('register_place')->nullable();
            $table->string('snils')->nullable();
            $table->string('polis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
