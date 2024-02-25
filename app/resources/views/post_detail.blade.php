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
            <p>販売者: <a href="{{ route('user.page', $post->user->id) }}">{{ $post->user->name }}</a></p>
            <p>売買状況: {{ $post->status_flg === 0 ? '販売中' : '売り切れ' }}</p>
            @if($post->status_flg === 0)
                <form action="{{ route('purchase.detail', $post->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">購入する</button>
                </form>
            @else
                <p style="color: red; font-weight: bold;">この商品は現在売り切れです。</p>
            @endif
        </div>
        <div class="col-md-6">
            <img src="{{ asset('images/' . $post->image) }}" alt="商品画像" class="img-thumbnail">
        </div>
    </div>
</div>

@endsection
