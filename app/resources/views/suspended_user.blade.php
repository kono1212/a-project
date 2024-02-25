<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>利用停止</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">利用停止</h1>
                <p class="card-text">あなたのアカウントは利用停止されています。</p>
                <button id="logout-btn" class="btn btn-primary">TOPに戻る</button>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (Optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // TOPに戻るボタンがクリックされたときの処理
        document.getElementById('logout-btn').addEventListener('click', function() {
            // ログアウトフォームを取得し、送信する
            document.getElementById('logout-form').submit();
        });
    </script>
    <!-- ログアウト用フォーム -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>
</html>
