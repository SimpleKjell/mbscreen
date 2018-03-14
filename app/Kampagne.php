<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kampagne extends Model
{
    // Table Name
    protected $table = 'kampagnes';
    // Primary Key
    public $primaryKey = 'id';
    //timestamps
    public $timestamps = true;
}
