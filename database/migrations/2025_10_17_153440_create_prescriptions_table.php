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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();

            // Link to PatientInformation
            $table->foreignId('patient_id')
                ->constrained('patient_information')
                ->cascadeOnDelete();

            // JSON prescription data (far/near, OD/OS)
            $table->json('prescription')->nullable();

            // Optional notes or remarks
            $table->text('remarks')->nullable();
            $table->integer('prescribed_by')->default(1);
            // $table->foreignId('prescribed_by')->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
