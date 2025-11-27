@extends('layouts.app')

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-center mb-8">All Products</h1>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach ($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>
@endsection
