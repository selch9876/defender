<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('mage_spell_id')->nullable();
            $table->unsignedBigInteger('player_class_id')->nullable();
            $table->unsignedBigInteger('monster_id')->nullable();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')
            ->onDelete('cascade');
            $table->foreign('mage_spell_id')->references('id')->on('mage_spells')
            ->onDelete('cascade');
            $table->foreign('monster_id')->references('id')->on('monsters')
            ->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
