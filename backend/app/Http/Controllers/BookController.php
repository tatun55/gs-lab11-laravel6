<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


//使うClassを宣言:自分で追加
use App\Book;   //Bookモデルを使えるようにする
use App\Stock;
use Validator;  //バリデーションを使えるようにする
use Auth;       //認証モデルを使用する
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    // //コンストラクタ(このクラスが呼ばれたら最初に処理をする)
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //本ダッシュボード表示
    public function index()
    {
        $books = Book::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'asc')
            // ->withTrashed()
            ->paginate(3);
        return view('books', [
            'books' => $books
        ]);
    }

    //更新画面
    public function edit(Book $book)
    {
        return view('booksedit', [
            'book' => $book
        ]);
    }

    //更新
    public function update(Request $request, Book $book)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|min:3|max:255',
            'item_number' => 'required|min:1|max:3',
            'item_amount' => 'required|min:0|max:6',
            'published' => 'required',
        ]);

        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $request->merge([
            'user_id' => Auth::user()->id,
        ]);
        $book->fill($request->all())->save();

        return redirect('/');
    }

    //登録
    public function store(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|min:3|max:255',
            'item_number' => 'required|min:1|max:3',
            'item_amount' => 'required|max:6',
            'published' => 'required',
        ]);

        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
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

        $request->merge([
            'item_img' => $filename,
            'user_id' => Auth::user()->id,
        ]);

        DB::beginTransaction();
        try {
            Book::create($request->all());
            Stock::find(1)->decrement('num', $request->item_number);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/')
                ->withInput()
                ->withErrors(array('stocks' => "在庫が足りません"));
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