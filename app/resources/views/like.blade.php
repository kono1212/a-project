<!-- like.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>いいね一覧</h1>
        <div class="row">
            @foreach ($userLikes as $like)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <!-- いいねした投稿の情報を表示 -->
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
