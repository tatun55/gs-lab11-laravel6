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
        BookComment::create([
            'book_id' => $book->id,
            'body' => $request->body,
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookComment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookComment $comment)
    {
        $comment->delete();
        return back();
    }
}