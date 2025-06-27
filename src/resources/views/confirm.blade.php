@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')
<h2>confirm</h2>

<form action="/thanks" method="POST">
    @csrf

    <dl>
        <dt>姓</dt>
        <dd>{{ $inputs['last_name'] }}</dd>
        <input type="hidden" name="last_name" value="{{ $inputs['last_name'] }}">

        <dt>名</dt>
        <dd>{{ $inputs['first_name'] }}</dd>
        <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}">

        <dt>性別</dt>
        <dd>
            @php
                $genderLabels = [1 => '男性', 2 => '女性', 3 => 'その他'];
            @endphp
            {{ $genderLabels[$inputs['gender']] ?? '不明' }}
        </dd>
        <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">

        <dt>メールアドレス</dt>
        <dd>{{ $inputs['email'] }}</dd>
        <input type="hidden" name="email" value="{{ $inputs['email'] }}">

        <dt>電話番号</dt>
        <dd>{{ $inputs['tel'] }}</dd>
        <input type="hidden" name="tel" value="{{ $inputs['tel'] }}">

        <dt>住所</dt>
        <dd>{{ $inputs['address'] }}</dd>
        <input type="hidden" name="address" value="{{ $inputs['address'] }}">

        <dt>建物名</dt>
        <dd>{{ $inputs['building'] }}</dd>
        <input type="hidden" name="building" value="{{ $inputs['building'] }}">

        <dt>お問い合わせの種類</dt>
        <dd>{{ $inputs['category_id'] }}</dd>
        <input type="hidden" name="category_id" value="{{ $inputs['category_id'] }}">

        <dt>お問い合わせ内容</dt>
        <dd>{{ $inputs['message'] }}</dd>
        <input type="hidden" name="message" value="{{ $inputs['message'] }}">
    </dl>

    <div class="buttons">
        {{-- 戻るボタン --}}
        <button type="submit" formaction="/contact" formmethod="GET">修正</button>

        {{-- 送信ボタン --}}
        <button type="submit">送信</button>
    </div>
</form>

@endsection