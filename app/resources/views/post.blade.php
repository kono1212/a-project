@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">商品名</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">商品画像</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">価格</label>
                    <input type="text" class="form-control" id="amount" name="amount">
                </div>
                <div class="mb-3">
                    <label for="explain" class="form-label">商品説明</label>
                    <textarea class="form-control" id="explain" rows="3" name="explain"></textarea>
                </div>
                <div class="mb-3">
                    <label for="condition" class="form-label">商品状態</label>
                    <input type="text" class="form-control" id="condition" name="condition">
                </div>
                <button type="submit" class="btn btn-primary">出品する</button>
            </form>
        </div>
    </div>
</div>

@endsection
