@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Створити товар</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('products.form')
            <button type="submit" class="btn btn-primary">Зберегти</button>
        </form>
    </div>
@endsection
