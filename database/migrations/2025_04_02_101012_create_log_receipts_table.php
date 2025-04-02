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
        Schema::create('log_receipts', function (Blueprint $table) {
            $table->id();
            $table->date('date_receipt');
            $table->string('time_receipt');
            $table->dateTime('datetime_alcohol')->nullable();
            $table->string('phone_agent')->nullable();
            $table->string('delivered')->nullable();
            $table->string('fact_alcohol')->nullable();
            $table->string('result_research')->nullable();
            $table->string('section_medical')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_receipts');
    }
};
