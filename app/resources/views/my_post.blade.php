@extends('layouts.app')

@section('content')

<!-- 商品詳細の表示 -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>{{ $post->title }}</h2>
            <form action="{{ route('post.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">商品名</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="amount">価格</label>
                    <input type="text" class="form-control" id="amount" name="amount" value="{{ $post->amount }}">
                </div>
                <div class="form-group">
                    <label for="explain">商品説明</label>
                    <textarea class="form-control" id="explain" name="explain">{{ $post->explain }}</textarea>
                </div>
                <div class="form-group">
                    <label for="condition">商品状態</label>
                    <input type="text" class="form-control" id="condition" name="condition" value="{{ $post->condition }}">
                </div>
                <!-- 更新ボタン -->
                <button type="submit" class="btn btn-primary">更新する</button>
            </form>
            <!-- 削除ボタン -->
            <form action="{{ route('post.delete', $post->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-2">削除する</button>
            </form>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('images/' . $post->image) }}" alt="商品画像" class="img-thumbnail">
        </div>
    </div>
</div>

@endsection
