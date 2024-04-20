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
            $table->unsignedInteger('tour_id');
            $table->string('name');
            $table->string('email');
            $table->unsignedInteger('country_id');
            $table->string('phone_number');
            $table->unsignedTinyInteger('adult');
            $table->unsignedTinyInteger('child');
            $table->string('title');
            $table->text('description');
            $table->boolean('status')->default(true)->comment('false: Đã gửi || true: Đã phản hồi');
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
