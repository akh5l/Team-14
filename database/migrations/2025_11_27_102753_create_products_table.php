<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->decimal('price', 10, 2);
            $table->enum('product_type', [
                'tabletop_games',
                'video_games',
                'video_games_accessories',
                'tabletop_accessories',
                'consoles'
            ]);
            $table->string('image_url')->nullable();

            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
