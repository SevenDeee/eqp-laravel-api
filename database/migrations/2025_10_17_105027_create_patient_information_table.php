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
        Schema::create('patient_information', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('name');
            $table->string('address');
            $table->string('contact_number');
            $table->integer('age');
            $table->string('sex', 10);

            // Product/Diagnosis Info
            $table->string('frame_type')->nullable();
            $table->string('color')->nullable();
            $table->string('lens_supply')->nullable();
            $table->text('diagnosis')->nullable();

            // Financials
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('deposit', 10, 2)->nullable();
            $table->decimal('balance', 10, 2)->nullable();

            // Notes and follow-up
            $table->text('special_instructions')->nullable();
            $table->timestamp('follow_up_on')->nullable();

            // Archival & tracking
            $table->integer('created_by')->default(1);
            // $table->foreignId('created_by')->constrained('users')->nullOnDelete();
            $table->timestamp('archived_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_information');
    }
};
