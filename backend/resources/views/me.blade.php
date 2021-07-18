<!-- resources/views/users.blade.php -->
@extends('layouts.app')
@section('content')
<!-- Bootstrapの定形コード… -->
<div class="card-body">

    @include('common.errors')
    <div class="row">
        <div class="h5 col-md-4">
            プロフィール
        </div>

        <div class="col-md-8 mx-auto">
            <form action="{{ url("me/{$user->id}") }}" method="POST">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="pref">都道府県</label>
                    <select class="form-control" name="pref">
                        @foreach(config('const.pref') as $i => $val)
                            <option value="{{ $i }}" {{ $i !== (old('pref') ?: @$user->profile->pref) ?: "selected" }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">誕生日</label>
                    <input type="date" name="birthday" class="form-control" value="{{ old('birthday') ?: @$user->profile->birthday }}">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ url('/') }}">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>



@endsection
