<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


//使うClassを宣言:自分で追加
use App\Book;   //Bookモデルを使えるようにする
use App\BookComment;
use App\Http\Requests\BookRequest;
use App\Stock;
use App\Tag;
use Validator;  //バリデーションを使えるようにする
use Auth;       //認証モデルを使用する
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //本ダッシュボード表示
    public function index(Request $request)
    {
        $query = Book::orderBy('item_name', 'asc')
            // ->withTrashed()
            ->withCount('comments');

        Auth::user()->role === 'user' && $query->where('user_id', Auth::user()->id);

        // ここに検索条件
        isset($request->item_name) && $query->where('item_name', 'like', "%{$request->item_name}%");
        isset($request->item_amount_from) && $query->where('item_amount', '>=', $request->item_amount_from);
        isset($request->item_amount_to) && $query->where('item_amount', '<=', $request->item_amount_to);
        isset($request->item_number_from) && $query->where('item_number', '>=', $request->item_number_from);
        isset($request->item_number_to) && $query->where('item_number', '<=', $request->item_number_to);
        isset($request->published_from) && $query->whereDate('published', '>=', $request->published_from);
        isset($request->published_to) && $query->whereDate('published', '<=', $request->published_to);
        isset($request->item_category) && $query->where('item_category', $request->item_category);
        if (isset($request->tags)) {
            foreach ($request->tags as $tagId) {
                $query->whereHas('tags', function ($query) use ($tagId) {
                    $query->where('tag_id', $tagId);
                });
            }
        }

        $books = $query->paginate(10);
        $tags = Tag::all();
        return view('books', [
            'books' => $books,
            'tags' => $tags,
        ]);
    }

    //更新画面
    public function edit(Book $book)
    {
        Auth::user()->id !== $book->user_id && abort(403);
        $bookComments = BookComment::where('book_id', $book->id)->get();
        $tags = Tag::all();
        $checkedTags = $book->tags()->pluck('tags.id')->toArray();
        return view('booksedit', [
            'book' => $book,
            'bookComments' => $bookComments,
            'tags' => $tags,
            'checkedTags' => $checkedTags,
        ]);
    }

    //更新
    public function update(BookRequest $request, Book $book)
    {
        Auth::user()->id !== $book->user_id && abort(403);
        Auth::user()->role === 'admin' && abort(403);
        $request->merge([
            'user_id' => Auth::user()->id,
        ]);
        $book->fill($request->all())->save();
        $book->tags()->sync($request->tags);

        return back();
    }

    //登録
    public function store(BookRequest $request)
    {
        Auth::user()->id !== $book->user_id && abort(403);
        Auth::user()->role === 'admin' && abort(403);
        //file 取得
        $file = $request->file('item_img'); //file が空かチェック
        if (!empty($file)) {
            //ファイル名を取得
            $filename = $file->getClientOriginalName();
            //AWSの場合どちらかになる事がある”../upload/” or “./upload/”
            $move = $file->move('./upload/', $filename); //public/upload/...
        } else {
            $filename = "";
        }

        $requestAll = array_merge($request->except('item_img'), [
            'item_img' => url("./upload/{$filename}"),
            'user_id' => Auth::user()->id,
        ]);

        DB::beginTransaction();
        try {
            $book = Book::create($requestAll);
            $book->tags()->sync($request->tags);
            Stock::find(1)->decrement('num', $request->item_number);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/')
                ->withInput()
                ->withErrors(array($e->getMessage()));
        }

        return redirect('/');
    }

    //削除処理
    public function destroy(Book $book)
    {
        Auth::user()->id !== $book->user_id && abort(403);
        Auth::user()->role === 'admin' && abort(403);
        $book->delete();
        return redirect('/');
    }
}