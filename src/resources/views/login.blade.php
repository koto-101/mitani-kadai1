@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('header-buttons')
    <a href="/register">Register</a>
@endsection

@section('content')
<div class="login-container">
    <h2>Login</h2>
    
    <form method="POST" action="/login">
        @csrf

        <!-- メールアドレス -->
        <div class="form-group">
            <label for="email">メールアドレス ※</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"placeholder="例：test@example.com">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- パスワード -->
        <div class="form-group">
            <label for="password">パスワード ※</label>
            <input type="password" id="password" name="password" placeholder="例：coachtech1106">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- ログインボタン -->
        <div class="form-group">
            <button type="submit">ログイン</button>
        </div>
    </form>
</div>


@endsection