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
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('category_id')
                ->comment('ID категории');

            $table->string('title')
                ->comment('Название');

            $table->decimal('price', 8, 2)
                ->comment('Цена');

            $table->timestamps();

            $table->comment('Товары');

            $table->foreign('category_id', 'item_category_key')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function(Blueprint $table) {
            $table->dropForeign('item_category_key');
        });

        Schema::dropIfExists('items');
    }
};
