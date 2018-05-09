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

          $table->text('image_content_1')->nullable();
          $table->text('image_content_2')->nullable();
          $table->text('image_content_3')->nullable();
          $table->text('image_content_4')->nullable();

          $table->text('image_kanal_1')->nullable();
          $table->text('image_kanal_2')->nullable();
          $table->text('image_kanal_3')->nullable();
          $table->text('image_kanal_4')->nullable();

          $table->text('video_art')->nullable();
          $table->text('video_url')->nullable();
          $table->text('video_duration')->nullable();




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
