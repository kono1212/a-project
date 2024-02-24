@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">購入確認</div>

                <div class="card-body">
                    <!-- 商品情報の表示 -->
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('images/' . $post->image) }}" alt="商品画像" class="img-thumbnail">
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $post->title }}</h3>
                            <p>価格: {{ $post->amount }}円</p>
                        </div>
                    </div>

                    <hr>

                    <!-- 購入者情報の表示 -->
                    <div class="row">
                        <div class="col-md-6">
                            <p>氏名: {{ $name }}</p>
                            <p>電話番号: {{ $tel }}</p>
                            <p>郵便番号: {{ $post_code }}</p>
                            <p>住所: {{ $address }}</p>
                        </div>
                    </div>

                    <!-- 購入完了ボタン -->
                    <div class="row">
                        <div class="col-md-6">
                                <form method="POST" action="{{ route('purchase.complete') }}">
    @csrf
    <input type="hidden" name="name" value="{{ $name }}">
    <input type="hidden" name="tel" value="{{ $tel }}">
    <input type="hidden" name="post_code" value="{{ $post_code }}">
    <input type="hidden" name="address" value="{{ $address }}">

    <input type="hidden" name="post_id" value="{{ $post->id }}">

    <button type="submit" class="btn btn-primary">購入完了</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
