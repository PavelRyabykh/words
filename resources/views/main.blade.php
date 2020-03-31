@extends('layouts.main')
@section('title', 'Categories')
@section('content')
    <main role="main">
        @include('blocks.h1', ['text' => 'Категории'])
        @include('modals.update-category')
        @include('modals.create-category')
        <div class="album bg-light pt-1">
            <div class="container">
                <div id="row" class="row">
                    @each('blocks.category', $categories, 'category')
                </div>
            </div>
        </div>

    </main>
@endsection
