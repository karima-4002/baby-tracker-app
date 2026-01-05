<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('growth_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('baby_id')->constrained()->onDelete('cascade');
            $table->date('measurement_date');
            $table->decimal('weight', 5, 2);
            $table->decimal('height', 5, 2);
            $table->decimal('head_circumference', 5, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('growth_records');
    }
};
