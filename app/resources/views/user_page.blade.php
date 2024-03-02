@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- ユーザーアイコン -->
            @if($user->image)
            <img src="{{ asset('/' . $user->image) }}" alt="User Avatar" class="rounded-circle" style="width: 100px; height: 100px;">
            @else
            <img src="{{ asset('/default.jpg') }}" alt="" class="rounded-circle" style="width: 100px; height: 100px;">
            @endif
            <h2 style="margin-top: 5px;">{{ $user->name }}</h2>

        <!-- フォローボタン -->
        @if (Auth::check() && Auth::id() != $user->id)
            <button class="follow-toggle btn btn-primary" data-user-id="{{ $user->id }}">
                {{ $user->isFollowedBy(Auth::user()) ? 'フォロー解除' : 'フォロー' }}
            </button>
        @endif


            <div class="mt-3">
                <p>{{ $user->profile }}</p>
            </div>
        </div>
        <div class="col-md-9" >
            <h5 style="margin-top: 20px;">{{ $user->name }} が出品した商品</h5>
            <!-- 出品商品一覧 -->
            <div class="row" style="margin-top: 30px;">
                @isset($posts)
                    @foreach ($posts as $post)
                        @if ($post->del_flag == 0) <!-- 非表示フラグが0の場合のみ表示 -->
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <!-- 商品画像のリンク -->
                                    <a href="{{ Auth::id() == $post->user_id ? route('my.post', $post->id) : route('post.detail', $post->id) }}">
                                        <img src="{{ asset('images/' . $post->image) }}" class="card-img-top" alt="商品画像">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text">¥{{ $post->amount }}</p>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // フォローボタンのクリックイベントを監視
        $('.follow-toggle').click(function (e) {
            e.preventDefault(); // デフォルトのイベントをキャンセル

            // クリックされたボタンの要素を保存
            var $this = $(this);
            
            // フォローボタンがクリックされたユーザーのIDを取得
            var userId = $this.data('user-id');

            // ルート名を定義
            var routeUrl = "{{ route('follow.toggle', ['id' => ':userId']) }}";
            routeUrl = routeUrl.replace(':userId', userId);

            // CSRFトークンを取得
            var csrfToken = '{{ csrf_token() }}';

            // Ajaxリクエストを送信
            $.ajax({
                type: 'POST',
                url: routeUrl,
                data: {
                    user_id: userId,
                    _token: csrfToken
                },
            })
            .done(function (data) {
                // 成功時の処理
                // ボタンのテキストを切り替える
                if (data) {
                    $this.text('フォロー解除');
                } else {
                    $this.text('フォロー');
                }
            })
            .fail(function () {
                // 失敗時の処理
                alert('エラーが発生しました');
            });
        });
    });
</script>





