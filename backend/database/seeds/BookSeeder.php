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
        $qt = 300;
        $books = [];
        $tags = [];
        $bookComments = [];
        for ($i = 1; $i <= $qt; $i++) {
            $book = [
                'user_id' => 1,
                'item_name' => sprintf("Book Title No.%03d", $i),
                'item_amount' => rand(100, 9999),
                'item_number' => rand(1, 10),
                'item_img' => "https://dummyimage.com/300x300/cccccc/ffffff&text=ダミー画像",
                'published' => Carbon::today()->subDays(rand(1, 100))->format("Y-m-d"),
                'item_category' => rand(1, 3),
            ];
            $books[] = $book;

            $tagIds = Arr::random(range(1, 3), rand(0, 3));
            foreach ($tagIds as $id) {
                $tags[] = [
                    'book_id' => $i,
                    'tag_id' => $id,
                ];
            }
            for ($j = 1; $j < rand(0, 10); $j++) {
                $bookComments[] = [
                    'book_id' => $i,
                    'body' => "Commend No.{$j}",
                ];
            }
        }
        Book::insert($books);
        DB::table('book_tag')->insert($tags);
        BookComment::insert($bookComments);
    }
}