<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_instances', function (Blueprint $table) {
          $table->increments('id');
          $table->text('title');
          $table->text('picture');
          $table->text('desc');
          $table->text('social_id');
          $table->text('anz_posts');
          $table->text('use_wall');
          $table->text('page_id');
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
        Schema::dropIfExists('social_instances');
    }
}
