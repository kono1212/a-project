@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- 検索フォーム -->
            <form action="{{ route('search') }}" method="GET" class="mb-3">
                <div class="input-group mb-3">
                    <!-- キーワード入力 -->
                    <input type="text" class="form-control" placeholder="キーワードを入力してください" name="keyword" value="{{ request('keyword') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">検索</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price">価格絞り込み：</label>
                    <!-- 価格絞り込み選択 -->
                    <select class="form-control" id="price" name="price">
                        <option value="">価格選択</option>
                        <option value="0-1000" {{ (request('price') == '0-1000') ? 'selected' : '' }}>~1000円</option>
                        <option value="1000-3000" {{ (request('price') == '1000-3000') ? 'selected' : '' }}>1000~3000円</option>
                        <option value="3000-5000" {{ (request('price') == '3000-5000') ? 'selected' : '' }}>3000~5000円</option>
                        <option value="5000-" {{ (request('price') == '5000-') ? 'selected' : '' }}>5000円以上</option>
                    </select>
                </div>
            </form>

            <!-- 商品写真の表示 -->
            <div class="row">
                @isset($posts)
                    @foreach ($posts as $post)
                       @if ($post->del_flag == 0)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <a href="{{ Auth::id() == $post->user_id ? route('my.post', $post->id) : route('post.detail', $post->id) }}">
                                        <img src="{{ asset('images/' . $post->image) }}" class="card-img-top" alt="商品画像">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text">{{ $post->amount }}円</p>
                                        <p class="card-text">{{ $post->explain }}</p>
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
