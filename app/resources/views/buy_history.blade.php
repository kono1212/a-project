@extends('layouts.app')

@section('content')
<div class="container">
    <h4 style="margin-top: 30px;">購入履歴</h4>
    
    <div class="row" style="margin-top: 30px;">
        @isset($purchasedItems)
            @foreach ($purchasedItems as $item)
                <div class="col-md-3 mb-3">
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
