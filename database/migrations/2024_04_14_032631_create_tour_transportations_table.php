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
        Schema::create('tour_transportations', function (Blueprint $table) {
            $table->id();
            $table->integer('tour_id')->comment('id của bảng tour');
            $table->integer('transportation_id')->comment('id của bảng transportation');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_transportations');
    }
};
