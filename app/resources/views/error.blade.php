<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
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
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">エラーが発生しました。</h4>
            <p>ページの表示中にエラーが発生しました。</p>
            <hr>
        </div>
        <a href="{{ route('logout') }}" class="btn btn-primary">ログアウト</a>
    </div>
</body>
</html>
