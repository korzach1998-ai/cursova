@extends('layouts.layout')

@section('content')
    <div id="form-container">
        <h1>@isset($category) Змінити @else Створити @endisset категорію</h1>

        <form action="@isset($category) {{ route('categories.update', $category->id) }} @else {{ route('categories.store') }} @endisset" method="POST">
            @csrf
            @isset($category)
                @method('PUT')
            @endisset

            <div>
                <label for="name" class="form-label">Назва</label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name ?? '') }}" required>
            </div>

            <div>
                <label for="description" class="form-label">Опис</label>
                <textarea id="description" name="description">{{ old('description', $category->description ?? '') }}</textarea>
            </div>

            <button type="submit">
                @isset($category) Змінити @else Зберегти @endisset
            </button>
        </form>
    </div>
@endsection
