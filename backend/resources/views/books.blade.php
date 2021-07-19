<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')
<!-- Bootstrapの定形コード… -->
<div class="card-body">
    <div class="card-title">
        本のタイトル
    </div>

    <!-- バリデーションエラーの表示に使用-->
    @include('common.errors')
    <!-- バリデーションエラーの表示に使用-->

    <!-- 本のタイトル -->
    <form enctype="multipart/form-data" action="{{ url('books') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="book" class="col-sm-3 control-label">Book</label>
                <input type="text" name="item_name" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label for="amount" class="col-sm-3 control-label">金額</label>
                <input type="text" name="item_amount" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="number" class="col-sm-3 control-label">数</label>
                <input type="text" name="item_number" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label for="published" class="col-sm-3 control-label">公開日</label>
                <input type="date" name="published" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="item_category" class="col-sm-3 control-label">カテゴリ</label>
                <select class="form-control" name="item_category">
                    <option value="1">文芸・評論</option>
                    <option value="2">ノンフィクション</option>
                    <option value="3">ビジネス・経済</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <p class="col-sm-3 control-label">タグ</p>
                @foreach($tags as $tag)
                    <label class="col-sm-3 control-label">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <!-- file 追加 -->
        <div class="form-row mb-3">
            <div class="col-sm-6"> <label>画像</label>
                <input type="file" name="item_img">
            </div>
        </div>

        <!-- 本 登録ボタン -->
        <div class="form-row">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>
</div>




<!-- Book: 既に登録されてる本のリスト -->
<!-- 現在の本 -->
@if(count($books) > 0)
    <div class="card-body">
        <div class="card-body">
            <table class="table table-striped task-table">
                <!-- テーブルヘッダ -->
                <thead>
                    <th>本一覧</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </thead>
                <!-- テーブル本体 -->
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <!-- 本タイトル -->
                            <td class="table-text">
                                <div>{{ $book->item_name }}</div>
                                <div> <img src="upload/{{ $book->item_img }}" width="100"></div>
                            </td>
                            <td class="table-text">
                                <div>コメント数：{{ $book->comments_count }}</div>
                            </td>

                            <!-- 本: 更新ボタン -->
                            <td>
                                <a class="btn btn-primary" href="{{ url("books/{$book->id}/edit") }}">編集</a>
                            </td>

                            <!-- 本: 削除ボタン -->
                            <td>
                                <form action="{{ url('books/'.$book->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">
                                        削除
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-md-4 offset-md-4">
                {{ $books->links() }}
            </div>
        </div>

    </div>
@endif



@endsection
