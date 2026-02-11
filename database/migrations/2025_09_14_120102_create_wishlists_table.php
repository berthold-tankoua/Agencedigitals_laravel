<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            // Relation avec l'utilisateur
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade'); // si user supprimé -> wishlist supprimée

            // Relation avec les produits
            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->onDelete('cascade'); // si produit supprimé -> wishlist supprimée

            // Relation avec les services (si tu as une table services)
            $table->foreignId('service_id')
                ->nullable()
                ->constrained('services')
                ->onDelete('cascade'); // si service supprimé -> wishlist supprimée

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
};
