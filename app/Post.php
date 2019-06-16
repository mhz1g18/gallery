<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['filename', 'filepath', 'uploaded_by', 'title', 'description', 'category'];
}
