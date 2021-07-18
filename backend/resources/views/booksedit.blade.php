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
                <input type="datetime" id="published" name="published" class="form-control" value="{{ old('published') ?: $book->published }}" />
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

            <!-- Saveボタン/Backボタン -->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-link pull-right" href="{{ url('/') }}">
                    Back
                </a>
            </div>
            <!--/ Saveボタン/Backボタン -->
        </form>
    </div>
</div>
@endsection
