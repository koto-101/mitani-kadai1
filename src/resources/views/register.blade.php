@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('header-buttons')
    <a href="/login" class="btn-link">Login</a>
@endsection

@section('content')
<div class="register-container">
    <h2>register</h2>

    <form action="/register" method="POST">
        @csrf

        <!-- 氏名 -->
        <div class="form-group">
            <label for="name">お名前 ※</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="例：山田太郎">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- メールアドレス -->
        <div class="form-group">
            <label for="email">メールアドレス ※</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="例：test@example.com">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- パスワード -->
        <div class="form-group">
            <label for="password">パスワード ※</label>
            <input type="password" name="password" id="password" placeholder="例：coachtech1106">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- 登録ボタン -->
        <div class="form-group">
            <button type="submit">登録</button>
        </div>
    </form>
</div>


@endsection