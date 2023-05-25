<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuestToMapObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('map_objects', function (Blueprint $table) {
            $table->unsignedBigInteger('quest_id')->nullable();
            $table->foreign('quest_id')->references('id')->on('quests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('map_objects', function (Blueprint $table) {
            $table->dropForeign(['quest_id']);
            $table->dropColumn('quest_id');
        });
    }
}
