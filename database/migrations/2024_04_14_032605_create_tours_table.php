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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('intro')->nullable();
            $table->text('overview')->nullable();
            $table->string('max_altitude')->nullable()->comment('độ cao tối đa');
            $table->string('departure_city')->nullable()->comment('thành phố khởi hành');
            $table->json('best_season')->nullable()->comment('mùa nên đi');
            $table->string('walking_hour')->nullable()->comment('thời gian đi bộ');
            $table->boolean('wifi')->nullable();
            $table->tinyInteger('min_age')->nullable();
            $table->tinyInteger('max_age')->nullable();
            $table->tinyInteger('quantity')->nullable()->comment('số lượng người');
            $table->tinyInteger('duration')->nullable()->comment('số ngày đi');
            $table->unsignedInteger('accommodation_id')->comment('id của bảng accommodation');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
