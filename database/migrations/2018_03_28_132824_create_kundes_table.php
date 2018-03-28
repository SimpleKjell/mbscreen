<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKundesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kundes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
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
        Schema::dropIfExists('kundes');
    }
}
