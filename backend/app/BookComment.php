<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookComment extends Model
{
    protected $fillable = ['book_id', 'body'];
}