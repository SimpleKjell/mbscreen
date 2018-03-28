<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
  // Table Name
  protected $table = 'socials';
  // Primary Key
  public $primaryKey = 'id';
  //timestamps
  public $timestamps = true;
  // Fillable
  protected $fillable = ['id', 'social', 'auth', 'key', 'pub'];

  /**
   * Get the comments for the blog post.
   */
  public function socialInstances()
  {
      return $this->hasMany('App\SocialInstance');
  }
}
