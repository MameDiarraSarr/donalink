<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campagnes', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->enum('type', ['financiere', 'materielle']);
            $table->decimal('objectif_montant', 10, 2)->nullable();
            $table->decimal('montant_collecte', 10, 2)->default(0);
            $table->enum('statut', ['active', 'cloturee'])->default('active');
            $table->date('date_fin')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campagnes');
    }
};