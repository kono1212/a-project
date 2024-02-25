<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザーリスト</title>
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
        <h1 class="text-center mb-4">ユーザーリスト</h1>
        <a href="{{ route('ownerpage') }}" class="btn btn-primary mb-3">戻る</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th>ユーザー区分</th>
                    <th>削除区分</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role === 0 ? '管理者' : '一般' }}</td>
                    <td>{{ $user->del_flag ? '削除済み' : '未削除' }}</td>
                    <td>
                        @if(!$user->del_flag)
                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.delete', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当に削除しますか？')">論理削除</button>
                            </form>
                        @else
                            <span class="text-muted">削除済み</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- ページネーションリンクの表示 -->
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
</body>
</html>
