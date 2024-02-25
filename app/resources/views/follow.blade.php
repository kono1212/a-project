@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>フォロー一覧</h1>
        
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <ul class="list-group">
                    @foreach ($followings as $following)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ asset('/' . $following->image) }}" alt="ユーザーアイコン" class="img-thumbnail">
                                </div>
                                <div class="col-md-8">
                                    {{ $following->name }}
                                    <a href="{{ route('user.page', ['id' => $following->id]) }}" class="btn btn-primary btn-sm float-right">ユーザー詳細</a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
