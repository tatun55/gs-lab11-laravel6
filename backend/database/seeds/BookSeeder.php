<?php

use App\Book;
use App\BookComment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [];
        for ($i = 1; $i <= 300; $i++) {
            $book = [
                'user_id' => 1,
                'item_name' => "Book Title No.{$i}",
                'item_amount' => rand(100, 9999),
                'item_number' => rand(1, 10),
                'item_img' => "https://dummyimage.com/300x300/cccccc/ffffff&text=ダミー画像",
                'published' => Carbon::today()->subDays(rand(1, 100))->format("Y-m-d"),
                'item_category' => rand(1, 3),
            ];
            $books[] = $book;
        }
        Book::insert($books);
    }
}