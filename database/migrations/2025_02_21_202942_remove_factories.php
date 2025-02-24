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
        Schema::dropIfExists('factories');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factories');
        Schema::create('factories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('tier');
            $table->string('land');
            $table->string('cost');
            $table->string('input');
            $table->string('output');
            $table->timestamps();
        });
    }
};
