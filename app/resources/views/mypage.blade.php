@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
<!-- ユーザーアイコン -->

<div class="d-flex align-items-center">
    <img src="{{ asset('storage/images/' . Auth::user()->image) }}" alt="User Avatar" class="rounded-circle" style="width: 50px; height: 50px;">
    <h5 class="ml-3">{{ Auth::user()->name }}</h5>
</div>



        
        <h1 class="text-center mb-4">マイページ</h1>
        
        <div class="d-flex flex-column align-items-center">
            <!-- アカウント情報編集ボタン -->
            <a href="{{ route('user.edit', ['id' => auth()->id()]) }}" class="btn btn-primary mb-2">アカウント情報編集</a>

            <!-- 売上履歴ボタン -->
            <a href="{{ route('sell.history') }}" class="btn btn-primary mb-2">売上履歴</a>
            
            <!-- 購入履歴ボタン -->
            <a href="{{ route('buy.history') }}" class="btn btn-primary mb-2">購入履歴</a>
            
            <!-- フォロー一覧ボタン -->
            <a href="{{ route('follow.list') }}" class="btn btn-primary mb-2">フォロー一覧</a>
            
            <!-- いいね一覧ボタン -->
            <a href="{{ route('like.list') }}" class="btn btn-primary mb-2">いいね一覧</a>
            
            <!-- 出品一覧ボタン -->
            <a href="{{ route('sell') }}" class="btn btn-primary mb-2">出品一覧</a>
        </div>
    </div>
@endsection
