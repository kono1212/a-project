@extends('layouts.app')

@section('content')

<!-- 商品詳細の表示 -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('images/' . $post->image) }}" alt="商品画像" class="img-thumbnail">
        </div>
        <div class="col-md-6">
            <h2>{{ $post->title }}</h2>
            <p>（{{ $post->status_flg === 0 ? '販売中' : '売り切れ' }}）</p>
            <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="image">商品画像</label>
                    <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage(event)">
                </div>
                <div class="form-group">
                    <img id="image-preview" src="#" alt="" style="max-width: 150px; max-height: 150px;">
                </div>
                <div class="form-group">
                    <label for="title">商品名</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                    <div id="title-error" class="text-danger"></div>
                </div>
                <div class="form-group">
                    <label for="amount">価格</label>
                    <input type="text" class="form-control" id="amount" name="amount" value="{{ $post->amount }}">
                    <div id="amount-error" class="text-danger"></div>
                </div>
                <div class="form-group">
                    <label for="explain">商品説明</label>
                    <textarea class="form-control" id="explain" name="explain">{{ $post->explain }}</textarea>
                    <div id="explain-error" class="text-danger"></div>
                </div>
                <div class="form-group">
                    <label for="condition">商品状態</label>
                    <input type="text" class="form-control" id="condition" name="condition" value="{{ $post->condition }}">
                    <div id="condition-error" class="text-danger"></div>
                </div>
                <!-- 更新ボタン -->
                @if ($post->status_flg === 0)
                    <button type="submit" class="btn btn-primary" style="margin-top: 15px;">商品情報を更新する</button>
                @else
                    <button type="submit" class="btn btn-primary" style="margin-top: 15px;" disabled>商品情報を更新できません</button>
                @endif
            </form>
            <!-- 削除ボタン -->
            @if ($post->status_flg === 0)
                <form action="{{ route('post.delete', $post->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-2">商品を削除する</button>
                </form>
            @else
                <button class="btn btn-danger mt-2" disabled>商品を削除できません</button>
            @endif
        </div>
    </div>
</div>

@endsection

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
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

        // 商品名のバリデーション
        if (title.trim() === '') {
            document.getElementById('title-error').textContent = '※商品名を入力してください';
            isValid = false;
        } else {
            document.getElementById('title-error').textContent = '';
        }

        // 価格のバリデーション
        if (amount.trim() === '') {
            document.getElementById('amount-error').textContent = '※価格を入力してください';
            isValid = false;
        } else {
            document.getElementById('amount-error').textContent = '';
        }

        // 商品説明のバリデーション
        if (explain.trim() === '') {
            document.getElementById('explain-error').textContent = '※商品説明を入力してください';
            isValid = false;
        } else {
            document.getElementById('explain-error').textContent = '';
        }

        // 商品状態のバリデーション
        if (condition.trim() === '') {
            document.getElementById('condition-error').textContent = '※商品状態を入力してください';
            isValid = false;
        } else {
            document.getElementById('condition-error').textContent = '';
        }

        return isValid;
    }
</script>
