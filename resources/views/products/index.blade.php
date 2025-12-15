@extends('layouts.layout')

@section('content')
<div id="products-container">
    <h1>Товари</h1>

    @if (Auth::check())
    <div class="add-btn-container">
        <a href="{{ route('products.create') }}">Додати товар</a>
    </div>
    @endif

    <div id="search-filter">
        <div class="filter-container">
            <div id="category-filter-box">
                <h3>Фільтрувати по категоріям</h3>
                <form action="{{ route('products.index') }}" method="GET">
                    <select name="category_id" onchange="this.form.submit()">
                        <option value="">Всі категорії</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == request('category_id') ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    
        <div class="search-container">
            <form action="{{ route('products.index') }}" method="GET" id="search-form">
                <input type="text" name="query" placeholder="Пошук по товарам..." value="{{ request('query') }}">
                <button type="submit">Пошук</button>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
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

    @if($products->isEmpty())
        <p>Немає доступних товарів</p>
    @else
        <div id="product-cards">
            @foreach ($products as $product)
                <div class="product-card">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                    <h2>{{ $product->name }}</h2>
                    <p>{{ $product->price }} ₴</p>
                    <div class="card-actions view-btn-container">
                        <a href="{{ route('products.show', $product->id) }}">Детальніше</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="pagination-container">
        {{ $products->links('paginateNav') }}
    </div>
</div>

<script>
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';

            setTimeout(() => {
                alert.remove();
            }, 500);
        });
    }, 5000);   
</script>
@endsection
