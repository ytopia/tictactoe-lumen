<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateGamesTable
 */
class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uid_x');
            $table->integer('uid_o');
            $table->integer('field1')->default(-1);
            $table->integer('field2')->default(-1);
            $table->integer('field3')->default(-1);
            $table->integer('field4')->default(-1);
            $table->integer('field5')->default(-1);
            $table->integer('field6')->default(-1);
            $table->integer('field7')->default(-1);
            $table->integer('field8')->default(-1);
            $table->integer('field9')->default(-1);
            $table->integer('last_uid')->default(0);
            $table->enum('result', ['win', 'draw', 'process'])->default('process');
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
        Schema::dropIfExists('games');
    }
}
