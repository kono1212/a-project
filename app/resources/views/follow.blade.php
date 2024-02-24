@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>フォロー一覧</h1>
        
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <ul class="list-group">
                    @foreach ($followings as $following)
                        <li class="list-group-item">{{ $following->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
