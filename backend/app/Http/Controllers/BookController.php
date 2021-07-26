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
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function practice()
    {
        echo ("<h1>これはEloquentなクエリビルダの練習です。</h1>");

        echo ("<h2>練習１：クエリビルダと結果取得メソッド</h2>");
        echo ("自分が登録した本データを取得するクエリ");
        Book::where('user_id', Auth::user()->id)->dump();

        echo ("自分が登録した本データ（Eloquent Collection）を取得");
        Book::where('user_id', Auth::user()->id)->get()->dump();

        echo ("（Eloquentを使わないバージョン）自分が登録した本データを取得するクエリ");
        DB::table('books')->where('user_id', Auth::user()->id)->dump();

        echo ("（Eloquentを使わないバージョン）自分が登録した本データ（Eloquent Collection）を取得");
        DB::table('books')->where('user_id', Auth::user()->id)->get()->dump();

        echo ("<h2>練習２：結果取得メソッドの具体例</h2>");
        echo ("findの例　IDが100の本を取得");
        $book = Book::find(100);
        dump($book);

        echo ("getの例　数量が10個の本一覧");
        $books = Book::where('item_number', 10)->get();
        dump($books);

        echo ("firstの例　数量が10個の本、最初の一冊");
        $book = Book::where('item_number', 10)->first();
        dump($book);

        echo ("paginateの例　数量が10個の本一覧を3冊ごとにパジネーションしたもの");
        $books = Book::where('item_number', 10)->paginate(3);
        dump($books);

        echo ("<h2>練習３：Where句</h2>");

        echo ("数量が5個以上");
        $books = Book::where('item_number', '>', 5)->get()->toArray();
        dump($books);

        echo ("数量が5個以上で、金額が1000円以下");
        $books = Book::where('item_number', '>', 5)
            ->where('item_amount', '<', 1000)
            ->get()
            ->toArray();
        dump($books);

        echo ("タイトルに`ジョバンニ`が含まれる");
        $books = Book::where('item_name', 'like', '%ジョバンニ%')
            ->get()
            ->toArray();
        dump($books);

        echo ("公開日が過去10日以内");
        $books = Book::whereDate('published', '>', Carbon::today()->subDays(10))
            ->get()
            ->toArray();
        dump($books);

        exit;
    }

    //本ダッシュボード表示
    public function index()
    {
        $books = Book::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'asc')
            // ->withTrashed()
            ->withCount('comments')
            ->paginate(10);
        $tags = Tag::all();
        return view('books', [
            'books' => $books,
            'tags' => $tags,
        ]);
    }

    //更新画面
    public function edit(Book $book)
    {
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
        $book->delete();
        return redirect('/');
    }
}