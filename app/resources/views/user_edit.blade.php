@extends('layouts.app')

@section('content')
<div class="container">
    <h4 style="margin-top: 30px;">アカウント情報編集</h4>
    
    <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3" style="margin-top: 40px;">
            <label for="name" class="form-label" >画像</label>
            <div class="d-flex align-items-center">
                @if(Auth::user()->image)
                <img src="{{ asset('/' . Auth::user()->image) }}" alt="User Avatar" class="rounded-circle" style="width: 100px; height: 100px;">
                @else
                <img src="{{ asset('/default.jpg') }}" alt="Default Avatar" class="rounded-circle" style="width: 100px; height: 100px;">
                @endif
            <div style="margin-left: 10px;">
                <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage(event)">
                <img id="preview" src="#" alt="" style="display: none; margin-top: 10px; max-width: 80px;">
            </div>
            </div>
        </div>

        <!-- ユーザー名入力のテキストボックス -->
        <div class="mb-3" style="margin-top: 30px;">
            <label for="name" class="form-label">ユーザー名</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- 自己紹介入力のテキストボックス -->
        <div class="mb-3" style="margin-top: 30px;">
            <label for="profile" class="form-label">自己紹介</label>
            <textarea class="form-control" id="profile" rows="3" name="profile">{{ $user->profile }}</textarea>
        </div>
        
        <!-- メールアドレス入力のテキストボックス -->
        <div class="mb-3" style="margin-top: 30px;">
            <label for="email" class="form-label">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <input type="hidden" name="user_id" value="{{ $user->id }}">
        
        <!-- アカウント情報を更新するアカウント情報更新ボタン -->
        <button type="submit" class="btn btn-primary" style="margin-top: 30px;">アカウント情報更新</button>
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

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var preview = document.getElementById('preview');
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
