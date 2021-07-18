<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['user_id', 'item_name', 'item_number', 'item_amount', 'item_img', 'published',];
}