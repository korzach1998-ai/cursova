@extends('layouts.layout')

@section('content')
<div id="categories-form-container">
    <h1>Категорії</h1>

    <div class="search-container">
        <form action="{{ route('categories.index') }}" method="GET" id="search-form">
            <input type="text" name="query" placeholder="Пошук по категорії..." value="{{ request('query') }}">
            <button type="submit">Пошук</button>
        </form>
    </div>
        
    <div class="add-btn-container">
        <a href="{{ route('categories.create') }}">Додати категорію</a>
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

    @if($categories->isEmpty())
        <p>Немає доступних категорій.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Назва</th>
                    <th>Опис</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <div class="edit-btn-container">
                                <a href="{{ route('categories.edit', $category->id) }}" class="edit-btn">Змінити</a>
                            </div>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="category-delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Ви впевнені, що хочете видалити дану категорію?')">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination-container">
            {{ $categories->links('paginateNav') }}
        </div>
    @endif
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
