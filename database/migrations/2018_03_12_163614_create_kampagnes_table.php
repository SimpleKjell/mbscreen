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
          $table->text('web_kpi_nutzer')->nullable();
          $table->text('web_kpi_aufrufe')->nullable();
          $table->text('fb_kpi_reichweite')->nullable();
          $table->text('fb_kpi_impressionen')->nullable();
          $table->text('fb_kpi_likes')->nullable();
          $table->text('fb_kpi_kommentare')->nullable();
          $table->text('fb_kpi_teilungen')->nullable();
          $table->text('fb_kpi_vid_views')->nullable();
          $table->text('insta_kpi_reichweite')->nullable();
          $table->text('insta_kpi_likes')->nullable();
          $table->text('insta_kpi_kommentare')->nullable();
          $table->text('insta_kpi_teilungen')->nullable();
          $table->text('insta_kpi_vid_views')->nullable();
          $table->text('category')->nullable();
          $table->text('art')->nullable();
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
