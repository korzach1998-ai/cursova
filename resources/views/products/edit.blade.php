@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Змінити товар</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('products.form', ['product' => $product])

            <button type="submit" class="btn btn-primary">Зберегти</button>
        </form>
    </div>
@endsection
