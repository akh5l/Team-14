@extends('layouts.app')

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-center mb-8">All Products</h1>

        <form action="{{ route('products') }}" method="GET" class="max-w-md mx-auto mb-8">
            <div class="flex items-center bg-white border border-gray-300 rounded-lg overflow-hidden shadown-sm">
                <input
                    type= "text"
                    name ="search"
                    value= "{{ request('search') }}"
                    placeholder="Search for products!"
                    class="w-full px-4 py-2 focus:outline-none">
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2">
                    Search
                </button>
            </div>
        </form>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach ($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>
@endsection
