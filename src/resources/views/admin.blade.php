@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('header-buttons')
    <form action="/logout" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="logout-button">Logout</button>
    </form>
@endsection

@section('content')
<div class="admin-container">

    <h2>Admin</h2>

    <form method="GET" action="/admin">
        @csrf
        <div class="search-form">
        <input type="text" id="keyword" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">
    </div>
                <select id="gender" name="gender">
                    <option value="">性別</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>
            </div>
            <div>
                <select id="category_id" name="category_id">
                    <option value="">お問い合わせ種類</option>
                    <option value="1" {{ request('category_id') == '1' ? 'selected' : '' }}>商品について</option>
                    <option value="2" {{ request('category_id') == '2' ? 'selected' : '' }}>配送について</option>
                    <option value="3" {{ request('category_id') == '3' ? 'selected' : '' }}>返品について</option>
                    <option value="4" {{ request('category_id') == '4' ? 'selected' : '' }}>その他</option>
                </select>
            </div>
            <div>
                <input type="date" id="date" name="date" value="{{ request('date') }}">
            </div>
        </div>
        <div class="form-buttons">
            <button type="submit">検索</button>
            <a href="{{ url('/admin') }}" class="reset-button">リセット</a>
        </div>
    </form>

    <form method="GET" action="{{ url('/admin/export') }}">
        <input type="hidden" name="name" value="{{ request('name') }}">
        <input type="hidden" name="name_match" value="{{ request('name_match') }}">
        <input type="hidden" name="email" value="{{ request('email') }}">
        <input type="hidden" name="email_match" value="{{ request('email_match') }}">
        <input type="hidden" name="gender" value="{{ request('gender') }}">
        <input type="hidden" name="category" value="{{ request('category') }}">
        <input type="hidden" name="category_match" value="{{ request('category_match') }}">
        <input type="hidden" name="date" value="{{ request('date') }}">
        <button type="submit">エクスポート</button>
    </form>

    <table border="1" cellpadding="5" cellspacing="0" style="margin-top:20px; width:100%;">
        <thead>
            <tr>
                <th>氏名</th>
                <th>メールアドレス</th>
                <th>性別</th>
                <th>お問い合わせ種類</th>
                <th>日付</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ ['未設定','男性','女性','その他'][$contact->gender] ?? '未設定' }}</td>
                <td>{{ $contact->category_id }}</td>
                <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                <td>
                    <div class="modal-wrapper">
                        <input type="checkbox" id="modal-toggle-{{ $contact->id }}" class="modal-toggle" hidden>
                        <label for="modal-toggle-{{ $contact->id }}" class="btn-detail">詳細</label>

                        <div class="modal">
                            <label for="modal-toggle-{{ $contact->id }}" class="modal-overlay"></label>
                            <div class="modal-content">
                                <label for="modal-toggle-{{ $contact->id }}" class="modal-close">×</label>
                                <h2>お問い合わせ詳細</h2>
                                <p><strong>氏名：</strong>{{ $contact->last_name }} {{ $contact->first_name }}</p>
                                <p><strong>メール：</strong>{{ $contact->email }}</p>
                                <p><strong>性別：</strong>{{ ['未設定','男性','女性','その他'][$contact->gender] ?? '未設定' }}</p>
                                <p><strong>カテゴリ：</strong>{{ $contact->category_id }}</p>
                                <p><strong>内容：</strong>{{ $contact->content }}</p>
                                <form method="POST" action="{{ route('admin.delete', $contact->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-delete" onclick="return confirm('本当に削除しますか？')">削除</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 10px;">
        {{ $contacts->appends(request()->query())->links() }}
    </div>

</div>
@endsection