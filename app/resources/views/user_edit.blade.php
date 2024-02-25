@extends('layouts.app')

@section('content')
<div class="container">
    <h1>アカウント情報編集</h1>
    
    <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        <!-- ユーザーアイコン表示部分 -->
        <div class="mb-3">
            <!-- 現在のユーザー画像を表示する -->
            <img src="{{ asset('/' . Auth::user()->image) }}" alt="User Avatar" class="rounded-circle" style="width: 100px; height: 100px;">
            <div style="margin-top: 10px;">
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
        </div>

        <!-- ユーザー名入力のテキストボックス -->
        <div class="mb-3">
            <label for="name" class="form-label">ユーザー名</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>
        
        <!-- 自己紹介入力のテキストボックス -->
        <div class="mb-3">
            <label for="profile" class="form-label">自己紹介</label>
            <textarea class="form-control" id="profile" rows="3" name="profile">{{ $user->profile }}</textarea>
        </div>
        
        <!-- メールアドレス入力のテキストボックス -->
        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>

        <input type="hidden" name="user_id" value="{{ $user->id }}">
        
        <!-- アカウント情報を更新するアカウント情報更新ボタン -->
        <button type="submit" class="btn btn-primary">アカウント情報更新</button>
    </form>

    <!-- アカウントを論理削除するフォーム -->
    <form method="POST" action="{{ route('user.delete.confirm', $user->id) }}" class="mt-3">
        @csrf
        @method('DELETE')
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <button type="submit" class="btn btn-danger">アカウントを削除</button>
    </form>
</div>
@endsection
