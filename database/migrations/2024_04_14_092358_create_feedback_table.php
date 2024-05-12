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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->string('phone_number');
            $table->unsignedTinyInteger('adult');
            $table->unsignedTinyInteger('child');
            $table->string('title');
            $table->text('description');
            $table->tinyInteger('status')->default(1)->comment('1: Đã nhận || 2: Đã xem || 3: Đã phản hồi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
