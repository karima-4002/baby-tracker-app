<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feeding_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('baby_id')->constrained()->onDelete('cascade');
            $table->string('feeding_type'); // breast, bottle, solid
            $table->string('food_type')->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->string('unit')->nullable(); // ml, oz, g
            $table->dateTime('feeding_time');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feeding_logs');
    }
};
