<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookComment;
use Illuminate\Http\Request;

class BookCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Book $book)
    {
        return "store";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookComment  $bookComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookComment $bookComment)
    {
        return "destroy";
    }
}