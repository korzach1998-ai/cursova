@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Змінити категорію</h1>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('categories.form', ['category' => $category])
            <button type="submit" class="btn btn-primary">Зберегти</button>
        </form>
    </div>
@endsection
