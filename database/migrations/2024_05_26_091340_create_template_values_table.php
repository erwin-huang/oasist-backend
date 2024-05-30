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
        Schema::create('template_values', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('template_section_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('code');
            $table->string('type');
            $table->string('value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_values');
    }
};
