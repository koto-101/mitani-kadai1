@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}" />
@endsection

@section('content')

<h2>contact<h2>

<form action="/confirm" method="POST">
    @csrf

    {{-- 氏名 --}}
    <div>
        <label>姓 ※</label><br>
        <input type="text" name="last_name" value="{{ old('last_name') }}">
        @error('last_name')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>名 ※</label><br>
        <input type="text" name="first_name" value="{{ old('first_name') }}">
        @error('first_name')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    {{-- 性別 --}}
    <div>
        <label>性別 ※</label><br>
        <label><input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}> 男性</label>
        <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性</label>
        <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他</label>
        @error('gender')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    {{-- メールアドレス --}}
    <div>
        <label>メールアドレス ※</label><br>
        <input type="text" name="email" value="{{ old('email') }}">
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    {{-- 電話番号 --}}
    <div>
        <label>電話番号 ※</label><br>

        <input type="text" name="tel1" value="{{ old('tel1') }}" size="4" maxlength="5"> -
        <input type="text" name="tel2" value="{{ old('tel2') }}" size="4" maxlength="4"> -
        <input type="text" name="tel3" value="{{ old('tel3') }}" size="4" maxlength="4">

        @if($errors->has('tel'))
            <div class="error">{{ $errors->first('tel') }}</div>
        @endif  
    </div>

    {{-- 住所 --}}
    <div>
        <label>住所 ※</label><br>
        <input type="text" name="address" value="{{ old('address') }}">
        @error('address')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    {{-- 建物名（任意） --}}
    <div>
        <label>建物名</label><br>
        <input type="text" name="building" value="{{ old('building') }}">
    </div>

    {{-- お問い合わせの種類 --}}
    <div>
        <label>お問い合わせの種類 ※</label><br>
        <select name="category_id">
            <option value="">選択してください</option>
            <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>商品について</option>
            <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>配送について</option>
            <option value="3" {{ old('category_id') == 3 ? 'selected' : '' }}>返品について</option>
            <option value="4" {{ old('category_id') == 4 ? 'selected' : '' }}>その他</option>
        </select>
        @error('category_id')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    {{-- お問い合わせ内容 --}}
    <div>
        <label>お問い合わせ内容 ※</label><br>
        <textarea name="message" rows="5" maxlength="120">{{ old('message') }}</textarea>
        @error('message')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    {{-- 確認ボタン --}}
    <div>
        <button type="submit">確認画面へ</button>
    </div>

</form>
@endsection