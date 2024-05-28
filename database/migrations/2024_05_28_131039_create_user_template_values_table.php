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
        Schema::create('user_template_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_value_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_template_section_id')->constrained()->cascadeOnDelete();
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_template_values');
    }
};
