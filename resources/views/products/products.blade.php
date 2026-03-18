@extends('layouts.app')

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-12">
        
        <h1 class="text-3xl font-bold text-center mb-8">
            {{ $currentCategory->category_name ?? 'All Products' }}
        </h1>

        <livewire:product-search :categories="$categories" :category-id="$currentCategory->id ?? null" />

    </section>
@endsection
