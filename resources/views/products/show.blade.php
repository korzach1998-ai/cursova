@extends('layouts.layout')

@section('content')
<div id="product-details" >
    <div class="product-card-left">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
    </div>
    <div class="product-card-right">
        <h1>{{ $product->name }}</h1>
        <p><strong>Опис:</strong> {{ $product->description }}</p>
        <p><strong>Ціна:</strong> ${{ $product->price }}</p>
        <p><strong>Категорія:</strong> {{ $product->category->name ?? 'Uncategorized' }}</p>
        <div class="product-actions">
            <div class="edit-btn-container d-flex align-items-center">
                <a href="{{ route('products.edit', $product->id) }}">Змінити</a>
            </div>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="product-delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn" onclick="return confirm('Ви впевнені, що хочете видалити даний товар?')">Видалити</button>
            </form>
        </div>
        <div class="back-btn-container">
            <a href="{{ route('products.index') }}">Назад до товарів</a>
        </div>
    </div>
</div>
@endsection
