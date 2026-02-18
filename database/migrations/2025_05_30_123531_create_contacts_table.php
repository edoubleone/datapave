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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('message');

                  // Attachment fields
            $table->string('attachment_path')->nullable();
            $table->string('attachment_original_name')->nullable();
            $table->unsignedBigInteger('attachment_size')->nullable(); // in bytes
            $table->string('attachment_mime_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
