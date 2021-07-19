<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'item_name', 'item_number', 'item_amount', 'item_img', 'published', 'item_category',];

    const CATEGORY = [
        1 => "文芸・評論",
        2 => "ノンフィクション",
        3 => "ビジネス・経済",
    ];

    public function comments()
    {
        return $this->hasMany('App\BookComment');
    }
}