<script type="text/javascript">
    $(document).ready(function () {
        // フォローボタンのクリックイベントを監視
        $('.follow-toggle').click(function (e) {
            e.preventDefault(); // デフォルトのイベントをキャンセル

            // フォローボタンがクリックされたユーザーのIDを取得
            var userId = $(this).data('user-id');

            // Ajaxリクエストを送信
            $.ajax({
                type: 'POST',
                url: '{{ route('follow.toggle', ['id' => $user->id]) }}',
                data: {
                    user_id: userId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    // 成功時の処理
                    if (data.success) {
                        // ボタンのテキストを切り替える
                        $(this).text(data.following ? 'フォロー解除' : 'フォローする');
                    } else {
                        alert('エラーが発生しました');
                    }
                }.bind(this), // コールバック内のthisをクリックされたボタンに束縛する
                error: function () {
                    alert('サーバーエラーが発生しました');
                }
            });
        });
    });
</script>

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
                <form action="{{ route('follow.toggle', $user->id) }}" method="POST">
                    @csrf
                    <button class="follow-toggle btn btn-primary" data-user-id="{{ $user->id }}">
                        {{ $user->isFollowedBy(Auth::user()) ? 'フォロー解除' : 'フォロー' }}
                    </button>
                </form>
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
