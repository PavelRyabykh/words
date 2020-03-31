@extends('layouts.main')
@section('title', $category->name)
@section('content')
    @include('blocks.h1', ['text' => $category->name])
    @include('modals.create-word')
    @include('modals.update-word')
    <table class="table table-dark mt-3">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Слово</th>
            <th scope="col">Транскрипция</th>
            <th scope="col">Перевод</th>
            <th scope="col" class="text-center">Пример</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @each('blocks.word', $words, 'word')
        </tbody>
    </table>

@endsection

