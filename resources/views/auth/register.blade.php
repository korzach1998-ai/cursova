@extends('layouts.layout')

@section('title', 'Register - RunFlow')

@section('content')
<div id="form-container">
    <h1>Регістрація</h1>

    @if ($errors->any())
        <div class="authErrors">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div>
            <label for="username">Ім'я користувача</label><br>
            <input type="text" name="username" id="username" value="{{ old('username') }}" required>
        </div>

        <div>
            <label for="email">Електронна пошта</label><br>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="password">Пароль</label><br>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <label for="password_confirmation">Підтвердження пароля</label><br>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>

        <button type="submit">
            Зареєструватися
        </button>
    </form>

    <div>
        Вже маєте акаунт? <a href="{{ route('login') }}">Вхід</a>
    </div>
</div>
@endsection
