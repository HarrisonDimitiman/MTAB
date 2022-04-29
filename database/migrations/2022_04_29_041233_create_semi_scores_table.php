<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemiScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semi_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('semi_id');
            $table->unsignedBigInteger('contestant_id');
            $table->double('total');
            $table->double('overAllTotal')->nullable();
            $table->double('overAllTotalJudge')->nullable();
            $table->double('score');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('semi_id')
                ->references('id')
                ->on('semis')
                ->onDelete('cascade');
                
            $table->foreign('contestant_id')
                ->references('id')
                ->on('contestants')
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
        Schema::dropIfExists('semi_scores');
    }
}
