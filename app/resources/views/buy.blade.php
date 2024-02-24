@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">購入情報入力</div>

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

                    <!-- 購入情報入力フォーム -->
                    <form method="POST" action="{{ route('purchase.confirm', ['post' => $post->id]) }}">

                        
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">氏名</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">電話番号</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control" name="tel" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_code" class="col-md-4 col-form-label text-md-right">郵便番号</label>

                            <div class="col-md-6">
                                <input id="post_code" type="text" class="form-control" name="post_code" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">住所</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" required>
                            </div>
                        </div>

                        <!-- 他の入力フォームを追加 -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    購入確認へ進む
                                </button>
                                <a href="{{ route('post.detail', $post->id) }}" class="btn btn-secondary">
                                    戻る
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
