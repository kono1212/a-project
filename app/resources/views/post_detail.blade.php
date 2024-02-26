@extends('layouts.app')

@section('content')

<!-- 商品詳細の表示 -->
<div class="container">
    <div class="row">
        <!-- 商品画像 -->
        <div class="col-md-4">
            <img src="{{ asset('images/' . $post->image) }}" alt="商品画像" class="img-thumbnail">
        </div>
        <!-- 商品情報 -->
        <div class="col-md-8">
            <h4>{{ $post->title }}</h4>
            <h2>¥{{ $post->amount }}</h2>
            <p><i class="fas fa-user"></i> <a href="{{ route('user.page', $post->user->id) }}">{{ $post->user->name }}</a></p>
            <!-- 購入ボタン -->
            @if($post->status_flg === 0)
                <form action="{{ route('purchase.detail', $post->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary mb-3" style="margin-top: 10px;">購入する</button>
                </form>
            @else
                <p style="color: red; font-weight: bold; margin-top: 10px;">この商品は現在売り切れです。</p>
            @endif

            <!-- 商品詳細 -->
            <div style="border: 1px solid #ccc; padding: 10px; margin-top: 10px; border-radius: 10px;">
                <p>商品説明: {{ $post->explain }}</p>
                <p>商品状態: {{ $post->condition }}</p>
            </div>
            <p style="font-size: 12px; font-weight: 300; margin-top: 10px;">商品登録日時: {{ $post->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>
</div>

@endsection
