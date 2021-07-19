@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('common.errors')
        <form action="{{ url("books/{$book->id}") }}" method="POST">
            @csrf
            @method('put')

            <!-- item_name -->
            <div class="form-group">
                <label for="item_name">Title</label>
                <input type="text" id="item_name" name="item_name" class="form-control" value="{{ old('item_name') ?: $book->item_name }}">
            </div>
            <!--/ item_name -->

            <!-- item_number -->
            <div class="form-group">
                <label for="item_number">Number</label>
                <input type="text" id="item_number" name="item_number" class="form-control" value="{{ old('item_number') ?: $book->item_number }}">
            </div>
            <!--/ item_number -->

            <!-- item_amount -->
            <div class="form-group">
                <label for="item_amount">Amount</label>
                <input type="text" id="item_amount" name="item_amount" class="form-control" value="{{ old('item_amount') ?: $book->item_amount }}">
            </div>
            <!--/ item_amount -->

            <!-- published -->
            <div class="form-group">
                <label for="published">published</label>
                <input type="date" id="published" name="published" class="form-control" value="{{ old('published') ?: $book->published }}" />
            </div>
            <!--/ published -->
            <div class="form-group">
                <label for="item_category" class="col-sm-3 control-label">カテゴリ</label>
                <select class="form-control" name="item_category">
                    @foreach($book::CATEGORY as $i => $v)
                        <option value="{{ $i }}" {{ $i === (integer)(old('item_category') ?: $book->item_category) ? "selected" : "" }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <p class="col-sm-3 control-label">タグ</p>
                @foreach($tags as $tag)
                    <label class="col-sm-3 control-label">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id,$checkedTags) ? 'checked' : '' }}>{{ $tag->name }}
                    </label>
                @endforeach
            </div>

            <!-- Saveボタン/Backボタン -->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-link pull-right" href="{{ url('/') }}">
                    Back
                </a>
            </div>
            <!--/ Saveボタン/Backボタン -->
        </form>

        <!-- comments -->
        <table class="table table-striped task-table mt-4">
            <thead>
                <th>コメント一覧</th>
                <th>&nbsp;</th>
            </thead>
            <tbody>
                @if(isset($bookComments) && !$bookComments->isEmpty())
                    @foreach($bookComments as $comment)
                        <tr>
                            <td class="table-text">
                                <p>{{ $comment->body }}</p>
                            </td>
                            <td>
                                <form action="{{ url("comments/{$comment->id}") }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        削除
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <form action="{{ url("books/{$book->id}/comments" ) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="comment">新規コメント</label>
                <input type="text" name="body" class="form-control" />
            </div>
            <div>
                <button type="submit" class="btn btn-primary">コメント投稿</button>
                <a class="btn btn-link" href="{{ url('/') }}">
                    Back
                </a>
            </div>
        </form>
        <!--/ comments -->
    </div>
</div>
@endsection
