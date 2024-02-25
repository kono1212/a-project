@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>出品一覧</h1>
        
        <div class="row">
            @isset($posts)
                @foreach ($posts as $post)
                    {{-- del_flagが0の場合のみ表示 --}}
                    @if ($post->del_flag == 0)
                        <div class="col-md-4 mb-3" style="max-width: 25%;">
                            <div class="card">
                                <!-- 商品画像の表示 -->
                                <a href="{{ Auth::id() == $post->user_id ? route('my.post', $post->id) : route('post.detail', $post->id) }}">
                                    <img src="{{ asset('images/' . $post->image) }}" class="card-img-top" alt="商品画像">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->amount }}円</p>
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
@endsection
