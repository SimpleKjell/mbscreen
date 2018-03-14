<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialInstance extends Model
{  

  /**
   * Get the Social that owns the Instance.
   */
  public function user()
  {
      return $this->belongsTo('App\Social');
  }
}
