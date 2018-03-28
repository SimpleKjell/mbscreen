<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kunde extends Model
{
  /**
   * Get the comments for the blog post.
   */
  public function socialInstances()
  {
      return $this->hasMany('App\SocialInstance');
  }
}
