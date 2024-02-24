@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>購入履歴</h1>
        
        <div class="row">
            @isset($purchasedItems)
                @foreach ($purchasedItems as $item)
                <div class="col-md-4 mb-3">
    <div class="card">
        @if ($item->post)
            <img src="{{ asset('images/' . $item->post->image) }}" class="card-img-top img-thumbnail" alt="商品画像">
            <div class="card-body">
                <h5 class="card-title">{{ $item->post->title }}</h5>
                <p class="card-text">{{ $item->post->amount }}円</p>
                <p class="card-text">購入日時: {{ $item->created_at }}</p>
            </div>
        @endif
    </div>
</div>

                @endforeach
            @endisset
        </div>
    </div>
@endsection
