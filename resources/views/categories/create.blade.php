@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Створити категорію</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            @include('categories.form')
            <button type="submit" class="btn btn-primary">Зберегти</button>
        </form>
    </div>
@endsection
