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
        Schema::create('dons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('campagne_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['financier', 'materiel']);
            $table->decimal('montant', 10, 2)->nullable();
            $table->string('description_materiel')->nullable();
            $table->integer('quantite')->nullable();
            $table->enum('mode_paiement', ['wave', 'orange_money', 'virement', 'especes'])->nullable();
            $table->boolean('anonyme')->default(false);
            $table->enum('statut', ['en_attente', 'confirme', 'annule'])->default('en_attente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dons');
    }
};
