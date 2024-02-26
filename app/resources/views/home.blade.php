@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> 
            <!-- 検索フォーム -->
            <div style="border: 1px solid #ced4da; border-radius: 5px; padding: 30px 50px 20px 50px;">
            <form action="{{ route('search') }}" method="GET" class="mb-3" >
                <div class="input-group mb-3">
                    <!-- キーワード入力 -->
                    <input type="text" class="form-control" placeholder="キーワードを入力してください" name="keyword" value="{{ request('keyword') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price">価格絞り込み：</label>
                    <!-- 価格絞り込み選択 -->
                    <select class="form-control" id="price" name="price">
                        <option value="">（未選択）</option>
                        <option value="0-1000" {{ (request('price') == '0-1000') ? 'selected' : '' }}>~¥1000</option>
                        <option value="1000-3000" {{ (request('price') == '1000-3000') ? 'selected' : '' }}>¥1000~¥3000</option>
                        <option value="3000-5000" {{ (request('price') == '3000-5000') ? 'selected' : '' }}>¥3000~¥5000</option>
                        <option value="5000-" {{ (request('price') == '5000-') ? 'selected' : '' }}>¥5000~</option>
                    </select>
                </div>
            </form>
            </div>

            <!-- 商品写真の表示 -->
            <h6 class="mb-4" style="margin-top: 40px;">出品された商品一覧</h6>
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
                                        <h6 class="card-title">{{ $post->title }}</h6>
                                        <h5 class="card-text font-weight-bold">¥{{ $post->amount }}</h5>
                                        <p class="card-text" style="font-size: 13px;">{{ $post->explain }}</p>
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
