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
            $table->dateTime('datetime_alcohol');
            $table->string('time_receipt');
            $table->string('phone_agent');
            $table->string('delivered');
            $table->string('fact_alcohol');
            $table->string('result_research');
            $table->string('section_medical');
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
