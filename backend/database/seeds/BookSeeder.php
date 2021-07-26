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
        factory(App\Book::class, 300)->create([
            'user_id' => 1,
        ]);

        $tags = [];
        for ($i = 1; $i <= 300; $i++) {
            $tagIds = Arr::random(range(1, 3), rand(0, 3));
            foreach ($tagIds as $id) {
                $tags[] = [
                    'book_id' => $i,
                    'tag_id' => $id,
                ];
            }
        }
        DB::table('book_tag')->insert($tags);

        factory(App\BookComment::class, 1000)->create();
    }
}