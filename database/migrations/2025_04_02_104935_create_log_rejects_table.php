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
        Schema::create('log_rejects', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('log_rejects');
    }
};
