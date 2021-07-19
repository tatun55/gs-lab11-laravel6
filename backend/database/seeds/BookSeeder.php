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
        Book::create([
            'user_id' => 1,
            'item_name' => 'プロご近所への道2',
            'item_amount' => 100,
            'item_number' => 3,
            'item_img' => "",
            'published' => Carbon::today(),
            'item_category' => 2,
        ]);
        Book::create([
            'user_id' => 1,
            'item_name' => 'プロご近所への道3',
            'item_amount' => 100,
            'item_number' => 3,
            'item_img' => "",
            'published' => Carbon::today(),
            'item_category' => 2,
        ]);
        for ($i = 1; $i <= 3; $i++) {
            factory(App\BookComment::class, rand(10, 100))->create([
                'book_id' => $i,
            ]);
        }
    }
}