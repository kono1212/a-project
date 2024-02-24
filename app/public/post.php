<form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">商品名</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group">
        <label for="image">商品画像</label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <div class="form-group">
        <label for="amount">価格</label>
        <input type="text" class="form-control" id="amount" name="amount">
    </div>
    <div class="form-group">
        <label for="explain">商品説明</label>
        <textarea class="form-control" id="explain" rows="3" name="explain"></textarea>
    </div>
    <div class="form-group">
        <label for="condition">商品状態</label>
        <input type="text" class="form-control" id="condition" name="condition">
    </div>
    <button type="submit" class="btn btn-primary">出品する</button>
</form>
