@extends('layouts.app')

@section('content')

<!-- 商品詳細の表示 -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>{{ $post->title }}</h2>
            <p>価格: {{ $post->amount }}円</p>
            <p>商品説明: {{ $post->explain }}</p>
            <p>商品状態: {{ $post->condition }}</p>
            <p>登録日時: {{ $post->created_at->format('Y-m-d H:i:s') }}</p>
            <!-- 販売者のユーザー名を表示し、リンク先をユーザーページに設定 -->
            <p>販売者: <a href="{{ route('user.page', $post->user->id) }}">{{ $post->user->name }}</a></p>
            <!-- 購入ボタン -->
            <form action="{{ route('purchase.detail', $post->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">購入する</button>
            </form>
            <!-- 他の商品情報をここに表示 -->
        </div>
        <div class="col-md-6">
            <img src="{{ asset('images/' . $post->image) }}" alt="商品画像" class="img-thumbnail">
        </div>
    </div>
</div>


@endsection
