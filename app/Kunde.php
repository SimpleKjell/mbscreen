<?php

namespace App;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

class Kunde extends Model
{
  use Mediable;

  /**
   * Get the comments for the blog post.
   */
  public function socialInstances()
  {
      return $this->hasMany('App\SocialInstance');
  }
}
