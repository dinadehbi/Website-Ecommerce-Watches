<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Colonne "id" (clé primaire, auto-increment)
            $table->string('title'); // Nom du produit
            $table->text('content')->nullable(); // Description du produit (nullable)
            $table->decimal('price', 8, 2); // Prix du produit (8 chiffres au total, 2 après la virgule)
            $table->integer('stock')->default(0); // Quantité du produit (valeur par défaut = 0)
            $table->timestamps(); // Colonnes "created_at" et "updated_at"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products'); // Supprimer table "products" ila dir rollback
    }
}