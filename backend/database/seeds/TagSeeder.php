<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::insert([
            ['name' => "喜び",],
            ['name' => "悲しみ",],
            ['name' => "興味深い",],
        ]);
    }
}