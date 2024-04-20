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
        Schema::create('tour_costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tour_id');
            $table->string('title');
            $table->boolean('include')->nullable()->comment('có bao gồm hay không');
            $table->tinyInteger('order')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_costs');
    }
};
