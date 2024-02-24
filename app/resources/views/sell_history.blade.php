@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>売上履歴</h1>
        
        <div class="row">
            @foreach ($soldItems as $item)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <!-- 商品画像の表示 -->
                        <img src="{{ asset('images/' . $item->image) }}" class="card-img-top img-thumbnail" alt="商品画像">
                        <div class="card-body">
                            <!-- 商品タイトルの表示 -->
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <!-- 更新日時の表示 -->
                            <p class="card-text">売上日時: {{ $item->updated_at }}</p>
                            <!-- 価格の表示 -->
                            <p class="card-text">{{ $item->amount }}円</p>
                            <!-- その他の情報を表示することもできます -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
