<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildTalentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('build_talent', function (Blueprint $table) {
            $table->id();
            $table->foreignId('build_id')->constrained();
            //$table->foreignId('talent_id')->constrained(); why this doesn't work?
            $table->unsignedBigInteger('talent_id');
            $table->foreign('talent_id')->references('id')->on('talents');
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
        Schema::dropIfExists('build_talents');
    }
}
