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
        Schema::create('donor_medical_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('organs_to_donate');
            $table->string('blood_type');
            $table->string('rh_factor');
            $table->text('preexisting_conditions')->nullable();
            $table->text('allergies')->nullable();
            $table->text('continuous_medication')->nullable();
            $table->boolean('alcohol_consumer');
            $table->boolean('smoker');
            $table->text('family_history')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donor_medical_info');
    }
};
