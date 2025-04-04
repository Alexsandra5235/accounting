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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('log_receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('log_id')->constrained()->onDelete('cascade');
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

            Schema::create('log_discharges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('log_id')->constrained('logs')->onDelete('cascade');
            $table->dateTime('datetime_discharge')->nullable();
            $table->dateTime('datetime_inform')->nullable();
            $table->string('outcome')->nullable();
            $table->string('section_transferred')->nullable();
            $table->timestamps();
        });

        Schema::create('log_rejects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('log_id')->constrained('logs')->onDelete('cascade');
            $table->string('reason_refusal')->nullable();
            $table->string('name_medical_worker')->nullable();
            $table->text('add_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
        Schema::dropIfExists('log_rejects');
        Schema::dropIfExists('log_discharges');
        Schema::dropIfExists('log_receipts');
    }
};
