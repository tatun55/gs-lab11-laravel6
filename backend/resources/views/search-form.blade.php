<div class="card p-5">
    <div class="card-title">
        検索フォーム
    </div>
    <form action="{{ url('/') }}" method="GET" class="form-horizontal">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="book" class="control-label col-12">Book</label>
                <input type="text" name="item_name" class="form-control">
            </div>

            <div class="form-group col-md-3">
                <label for="amount" class="control-label col-12">金額下限</label>
                <input type="text" name="item_amount_from" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="amount" class="control-label col-12">金額上限</label>
                <input type="text" name="item_amount_to" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="amount" class="control-label col-12">数下限</label>
                <input type="text" name="item_number_from" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="amount" class="control-label col-12">数上限</label>
                <input type="text" name="item_number_to" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="published" class="control-label col-12">公開日(ここから)</label>
                <input type="date" name="published_from" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="published" class="control-label col-12">公開日(ここまで)</label>
                <input type="date" name="published_to" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="item_category" class="control-label col-12">カテゴリ</label>
                <select class="form-control" name="item_category">
                    <option value="">選択なし</option>
                    <option value="1">文芸・評論</option>
                    <option value="2">ノンフィクション</option>
                    <option value="3">ビジネス・経済</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <p class="control-label col-12">タグ</p>
                <div class="form-group container row">
                    @foreach($tags as $tag)
                        <label class="control-label col-12 col-sm-4">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->name }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-primary">
                    検索
                </button>
            </div>
        </div>
    </form>
</div>
