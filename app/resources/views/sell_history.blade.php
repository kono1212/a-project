@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4 style="margin-top: 30px;">売上履歴</h4>
            </div>
            <div class="col-md-6">
                <div class="text-right" style="margin-top: 30px;">
                    <h5 style="font-size: 18px;">売上合計: ¥{{ $totalSales }}</h5>
                </div>
            </div>
        </div>
        
        <div class="row" style="margin-top: 30px;">
            @foreach ($soldItems as $item)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <img src="{{ asset('images/' . $item->image) }}" class="card-img-top img-thumbnail" alt="商品画像">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">売上日時: {{ $item->updated_at }}</p>
                            <p class="card-text">¥{{ $item->amount }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
