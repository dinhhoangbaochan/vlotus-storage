<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table Name 
    protected $table = 'posts';
    // Primary Key
    public $primary_key = 'id';
    // Timestamps
    public $time_stamps = true;
}
