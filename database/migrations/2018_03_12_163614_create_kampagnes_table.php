<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKampagnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kampagnes', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title');
          $table->mediumText('text_1')->nullable();
          $table->mediumText('text_2')->nullable();
          $table->mediumText('text_3')->nullable();
          $table->mediumText('text_4')->nullable();
          $table->text('kunden_id')->nullable();
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
        Schema::dropIfExists('kampagnes');
    }
}
