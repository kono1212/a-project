@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center mb-4" style="margin-top: 30px;">商品の出品</h3>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data" onsubmit="return validateForm()">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">商品名</label>
                    <input type="text" class="form-control" id="title" name="title">
                    <div id="title-error" class="text-danger"></div> <!-- 商品名のエラーメッセージ -->
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">商品画像</label>
                    <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage(event)">
                    <img id="image-preview" src="#" alt="" style="max-width: 100px; margin-top: 10px;">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">価格（円）</label>
                    <input type="text" class="form-control" id="amount" name="amount">
                    <div id="amount-error" class="text-danger"></div> <!-- 価格のエラーメッセージ -->
                </div>
                <div class="mb-3">
                    <label for="explain" class="form-label">商品説明</label>
                    <textarea class="form-control" id="explain" rows="3" name="explain"></textarea>
                    <div id="explain-error" class="text-danger"></div> <!-- 商品説明のエラーメッセージ -->
                </div>
                <div class="mb-3">
                    <label for="condition" class="form-label">商品状態</label>
                    <input type="text" class="form-control" id="condition" name="condition">
                    <div id="condition-error" class="text-danger"></div> <!-- 商品状態のエラーメッセージ -->
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">出品する</button>
            </form>
        </div>
    </div>
</div>

@endsection

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('image-preview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function validateForm() {
        var title = document.getElementById('title').value;
        var amount = document.getElementById('amount').value;
        var explain = document.getElementById('explain').value;
        var condition = document.getElementById('condition').value;
        var isValid = true;

        if (title.trim() === '') {
            document.getElementById('title-error').textContent = '※商品名を入力してください';
            isValid = false;
        } else {
            document.getElementById('title-error').textContent = ''; // エラーメッセージをクリア
        }

        if (amount.trim() === '') {
            document.getElementById('amount-error').textContent = '※価格を入力してください';
            isValid = false;
        } else {
            document.getElementById('amount-error').textContent = ''; // エラーメッセージをクリア
        }

        if (explain.trim() === '') {
            document.getElementById('explain-error').textContent = '※商品説明を入力してください';
            isValid = false;
        } else {
            document.getElementById('explain-error').textContent = ''; // エラーメッセージをクリア
        }

        if (condition.trim() === '') {
            document.getElementById('condition-error').textContent = '※商品状態を入力してください';
            isValid = false;
        } else {
            document.getElementById('condition-error').textContent = ''; // エラーメッセージをクリア
        }

        return isValid; // フォームが正常であれば送信されます
    }
</script>
