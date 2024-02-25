@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>売上履歴</h1>
        
        <div class="row">
            @foreach ($soldItems as $item)
                <div class="col-md-3 mb-3"> <!-- col-md-3 に変更してカードのサイズを小さくする -->
                    <div class="card">
                        <!-- 商品画像の表示 -->
                        <img src="{{ asset('images/' . $item->image) }}" class="card-img-top img-thumbnail" alt="商品画像">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">売上日時: {{ $item->updated_at }}</p>
                            <p class="card-text">{{ $item->amount }}円</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
