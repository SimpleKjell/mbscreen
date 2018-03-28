<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialInstance extends Model
{

  /**
   * Get the Social that owns the Instance.
   */
  public function social()
  {
      return $this->belongsTo('App\Social');
  }

  /**
   * Get the Social that owns the Instance.
   */
  public function kunde()
  {
      return $this->belongsTo('App\Kunde', 'kunden_id');
  }
}
