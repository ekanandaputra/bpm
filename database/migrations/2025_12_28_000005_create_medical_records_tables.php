<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->dateTime('visit_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('vitals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->constrained('medical_records')->onDelete('cascade')->unique();
            $table->string('blood_pressure')->nullable();
            $table->unsignedSmallInteger('heart_rate')->nullable();
            $table->decimal('body_temperature', 4, 1)->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('medical_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->constrained('medical_records')->onDelete('cascade')->unique();
            $table->text('diagnosis')->nullable();
            $table->text('clinical_findings')->nullable();
            $table->timestamps();
        });

        Schema::create('medical_record_medication', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->constrained('medical_records')->onDelete('cascade');
            $table->foreignId('medication_id')->constrained('medications')->onDelete('restrict');
            $table->string('dosage')->nullable();
            $table->string('frequency')->nullable();
            $table->string('duration')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_record_medication');
        Schema::dropIfExists('medical_assessments');
        Schema::dropIfExists('vitals');
        Schema::dropIfExists('medical_records');
    }
};
