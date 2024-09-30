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
        Schema::create('price_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fields_id')->index()->constrained();
            $table->string('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_fields');
    }
};
