<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fight_id');
            $table->foreign('fight_id')->references('id')->on('fights')->onDelete('cascade');
            $table->unsignedBigInteger('attacker_id');
            $table->enum('attacker_type', ['player', 'monster']);
            $table->unsignedBigInteger('defender_id');
            $table->enum('defender_type', ['player', 'monster']);
            $table->integer('turn')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rounds');
    }
}
