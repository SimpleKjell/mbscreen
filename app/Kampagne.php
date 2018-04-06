<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
// use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
// use Spatie\MediaLibrary\HasMedia\HasMedia;
use Plank\Mediable\Mediable;

class Kampagne extends Model
{
  use Mediable;
  // use HasMediaTrait;
  // Table Name
  protected $table = 'kampagnes';
  // Primary Key
  public $primaryKey = 'id';
  //timestamps
  public $timestamps = true;

  // public function registerMediaConversions(Media $media = null)
  // {
  //   $this->addMediaConversion('main')
  //     ->width(1200)
  //     ->height(720);
  //
  //   $this->addMediaConversion('side')
  //     ->width(1200)
  //     ->height(623);
  //
  //   $this->addMediaConversion('square')
  //     ->width(700)
  //     ->height(700);
  // }

  /**
   * Get the Social that owns the Instance.
   */
  public function kunde()
  {
      return $this->belongsTo('App\Kunde', 'kunden_id');
  }
}
