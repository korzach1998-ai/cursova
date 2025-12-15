@extends('layouts.layout')

@section('title', 'Login - RunFlow')

@section('content')
<div id="form-container">
    <h1>Вхід</h1>

    @if ($errors->any())
        <div class="authErrors">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="username">Ім'я користувача</label><br>
            <input type="text" name="username" id="username" value="{{ old('username') }}" required>
        </div>

        <div>
            <label for="password">Пароль</label><br>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit">
            Вхід
        </button>
    </form>

    <p>
        Немає існуючого акаунта? <a href="{{ route('register') }}">Регістрація</a>
    </p>
</div>
    
@endsection
