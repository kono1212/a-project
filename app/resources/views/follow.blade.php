@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 style="margin-top: 30px;">フォロー一覧</h4>
        
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-8 offset-md-2">
                <ul class="list-group">
                    @foreach ($followings as $following)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-2">
                                    @if($following->image)
                                    <img src="{{ asset('/' . $following->image) }}" alt="User Avatar" class="rounded-circle" style="width: 60px; height: 60px;">
                                    @else
                                    <img src="{{ asset('/default.jpg') }}" alt="Default Avatar" class="rounded-circle" style="width: 60px; height: 60px;">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <span style="font-size: 18px;">{{ $following->name }}</span>
                                    <a href="{{ route('user.page', ['id' => $following->id]) }}" class="btn btn-primary btn-sm float-right">詳細</a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
