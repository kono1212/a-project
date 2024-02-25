@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- 商品写真の表示 -->
            <div class="row">
                @isset($posts)
                    @foreach ($posts as $post)
                        @if ($post->del_flag == 0) <!-- 非表示フラグが0の場合のみ表示 -->
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <!-- 商品画像の表示 -->
                                    <a href="{{ route('login') }}"> <!-- ログインページへのリンク -->
                                        <img src="{{ asset('images/' . $post->image) }}" class="card-img-top" alt="商品画像">
                                    </a>
                                    <div class="card-body">
                                        <!-- 商品タイトルの表示 -->
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <!-- 価格の表示 -->
                                        <p class="card-text">{{ $post->amount }}円</p>
                                        <!-- その他の商品情報を表示することもできます -->
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endisset
            </div>

            <!-- ページネーションリンク -->
            <div class="d-flex justify-content-center mt-3">
                @isset($posts)
                    {{ $posts->appends(request()->input())->links() }}
                @endisset
            </div>
        </div>
    </div>
</div>
@endsection
