@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-danger" role="alert">
        本当にアカウントを削除しますか？
    </div>

    <form method="POST" action="{{ route('user.delete', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <!-- アカウント情報を論理削除するアカウントを削除ボタン -->
        <button type="submit" class="btn btn-danger">アカウントを削除</button>
    </form>
</div>
@endsection
