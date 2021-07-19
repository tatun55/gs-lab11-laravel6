<?php

use App\Book;
use App\BookComment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::create([
            'user_id' => 1,
            'item_name' => 'プロご近所への道',
            'item_amount' => 100,
            'item_number' => 3,
            'item_img' => "",
            'published' => Carbon::today(),
            'item_category' => 2,
        ]);
        BookComment::create([
            'book_id' => 1,
            'body' => '素晴らしい教訓。プロになる道が開かれた。',
        ]);
    }
}