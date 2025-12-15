@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>{{ isset($product) ? 'Змінити товар' : 'Додати товар' }}</h1>

        <!-- Show errors  -->
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($product))
                @method('PUT')
            @endif

            <div>
                <label for="name">Назва</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" require>
            </div>

            <div>
                <label for="description">Опис</label>
                <textarea id="description" name="description">{{ old('description', $product->description ?? '') }}</textarea>
            </div>

            <div>
                <label for="price">Ціна</label>
                <input type="text" id="price" name="price" value="{{ old('price', $product->price ?? '') }}" require>
            </div>

            <div>
                <label for="image">Картинка</label>
                <input type="file" id="image" name="image" class="form-control" require>
            </div>

            <div>
                <label for="category_id">Категорія</label>
                <select id="category_id" name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit">{{ isset($product) ? 'Змінити товар' : 'Додати товар' }}</button>
            </div>
        </form>
    </div>
@endsection
