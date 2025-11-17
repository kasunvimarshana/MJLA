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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->date('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->text('address')->nullable();
            $table->foreignId('course_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('language_program_id')->nullable()->constrained()->nullOnDelete();
            $table->string('education_level')->nullable();
            $table->string('japanese_level')->nullable();
            $table->text('motivation')->nullable();
            $table->string('status')->default('pending'); // pending, reviewing, approved, rejected, enrolled
            $table->dateTime('submitted_at')->nullable();
            $table->dateTime('reviewed_at')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('admin_notes')->nullable();
            $table->json('documents')->nullable(); // Store document paths
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'submitted_at']);
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
