<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Kampagne extends Model implements HasMedia
{
  use HasMediaTrait;
  // Table Name
  protected $table = 'kampagnes';
  // Primary Key
  public $primaryKey = 'id';
  //timestamps
  public $timestamps = true;

  public function registerMediaConversions(Media $media = null)
  {
    $this->addMediaConversion('main')
      ->width(1200)
      ->height(720);

    $this->addMediaConversion('side')
      ->width(1200)
      ->height(623);

    $this->addMediaConversion('square')
      ->width(700)
      ->height(700);
  }
}
