<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿リスト</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">投稿リスト</h1>
        <a href="{{ route('ownerpage') }}" class="btn btn-primary mb-3">戻る</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ユーザーID</th>
                    <th scope="col">商品名</th>
                    <th scope="col">商品画像</th>
                    <th scope="col">価格</th>
                    <th scope="col">売買状況</th>
                    <th scope="col">非表示フラグ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->user_id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->image }}</td>
                    <td>{{ $post->amount }}</td>
                    <td>{{ $post->status_flg == 0 ? '販売中' : '売り切れ' }}</td>
                    <td>
                        @if ($post->del_flag == 0)
                            <form action="{{ route('posts.update', $post->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">非表示</button>
                            </form>
                        @else
                            <button type="button" class="btn btn-secondary" disabled>非表示</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- ページネーションのリンクを追加 -->
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
    <!-- Bootstrap JS (Optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
