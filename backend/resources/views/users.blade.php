<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')
<!-- Bootstrapの定形コード… -->
<div class="card-body">
    <div class="card-title">
        ユーザー一覧
    </div>
    <div class="card-body">
        <div class="card-body">
            <table class="table table-striped task-table">
                <!-- テーブルヘッダ -->
                <thead>
                    <th>ユーザー名</th>
                    <th>ロール</th>
                    <th>登録した本の数</th>
                    <th>操作ボタン</th>
                </thead>
                <!-- テーブル本体 -->
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="table-text">
                                {{ $user->name }}
                            </td>
                            <td class="table-text">
                                {{ $user->role }}
                            </td>
                            <td>
                                {{ $user->books_count }}
                            </td>
                            <td>
                                <a href="{{ url('admin/users/'.$user->id) }}" type="submit" class="btn btn-primary">
                                    詳細
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-md-4 offset-md-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
