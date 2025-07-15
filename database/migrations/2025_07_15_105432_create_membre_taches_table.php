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
        Schema::create('membre_taches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('taches')->onDelete('cascade');
            $table->foreignId('member_id')->constrained('membres')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['task_id', 'member_id']);
            $table->index(['task_id']);
            $table->index(['member_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membre_taches');
    }
};
