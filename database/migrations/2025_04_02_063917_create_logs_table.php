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

        Schema::create('log_discharges', function (Blueprint $table) {
            $table->id();
            $table->dateTime('datetime_discharge')->nullable();
            $table->dateTime('datetime_inform')->nullable();
            $table->string('outcome')->nullable();
            $table->string('section_transferred')->nullable();
            $table->timestamps();
        });

        Schema::create('log_rejects', function (Blueprint $table) {
            $table->id();
            $table->string('reason_refusal')->nullable();
            $table->string('name_medical_worker')->nullable();
            $table->text('add_info')->nullable();
            $table->timestamps();
        });

        Schema::create('classifiers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('value')->nullable();
            $table->timestamps();
        });

        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->constrained('classifiers')->onDelete('cascade');
            $table->foreignId('wound_id')->constrained('classifiers')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diagnosis_id')->constrained('diagnoses')->onDelete('cascade');
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

        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('log_receipt_id')->constrained('log_receipts')->onDelete('cascade');
            $table->foreignId('log_discharge_id')->constrained('log_discharges')->onDelete('cascade');
            $table->foreignId('log_reject_id')->constrained('log_rejects')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_rejects');
        Schema::dropIfExists('log_discharges');
        Schema::dropIfExists('log_receipts');
        Schema::dropIfExists('classifiers');
        Schema::dropIfExists('diagnoses');
        Schema::dropIfExists('patients');
        Schema::dropIfExists('logs');
    }
};
