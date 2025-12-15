@extends('layouts.layout')

@section('title', 'RunFlow')

@section('content')
<div id="home">
    <div id="home-left">
        <img id="home-image" src="{{ asset('storage/images/home.jpg') }}" alt="Home Image" />
    </div>

    <div id="home-right">
        <div id="home-text">
        <p>Ласкаво просимо до <strong>RunFlow</strong> — магазину, де кожен крок має значення.</p>

        <p>Ми створюємо якісне спортивне взуття та екіпірування з турботою про ваш комфорт і результат.</p>

        @guest
            <p>
                Щоб отримати повний доступ до функціоналу, будь ласка, <a href="{{ route('login') }}">увійдіть</a> або 
                <a href="{{ route('register') }}">створіть акаунт</a> і розпочніть свою активну подорож разом із нами!
            </p>
        @endguest

        </div>
    </div>
</div>
@endsection

