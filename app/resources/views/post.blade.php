@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center mb-4" style="margin-top: 30px;">商品の出品</h3>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">商品名</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">商品画像</label>
                    <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage(event)">
                    <img id="image-preview" src="#" alt="" style="max-width: 100px; margin-top: 10px;">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">価格</label>
                    <input type="text" class="form-control" id="amount" name="amount">
                </div>
                <div class="mb-3">
                    <label for="explain" class="form-label">商品説明</label>
                    <textarea class="form-control" id="explain" rows="3" name="explain"></textarea>
                </div>
                <div class="mb-3">
                    <label for="condition" class="form-label">商品状態</label>
                    <input type="text" class="form-control" id="condition" name="condition">
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
</script>
