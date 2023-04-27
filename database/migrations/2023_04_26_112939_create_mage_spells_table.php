<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMageSpellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mage_spells', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->unsignedBigInteger("level");
            $table->unsignedBigInteger("mc");
            $table->unsignedBigInteger("damage");
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
        Schema::dropIfExists('mage_spells');
    }
}
