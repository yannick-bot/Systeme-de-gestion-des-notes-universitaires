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
        Schema::create('e_c_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ue_id')->constrained('u_e_s')->cascadeOnDelete();
            $table->string('code')->unique();
            $table->string('nom');
            $table->integer('coefficient');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_c_s');
    }
};
