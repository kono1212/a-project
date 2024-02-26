@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ご注文完了</div>

                <div class="card-body">
                    <p>ご注文が完了しました。</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">ホームへ戻る</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
