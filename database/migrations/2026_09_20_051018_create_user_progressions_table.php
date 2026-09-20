<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * État courant de progression, une ligne par utilisateur. Toutes les mesures
     * sont non signées : rien ici ne peut représenter une perte ou une pénalité.
     */
    public function up(): void
    {
        Schema::create('user_progressions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained();
            $table->unsignedSmallInteger('level')->default(1);
            $table->unsignedInteger('total_xp')->default(0);
            $table->decimal('momentum_score', 5, 2)->default(0);
            $table->timestamp('momentum_computed_at')->nullable();
            $table->string('avatar_variant')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_progressions');
    }
};
