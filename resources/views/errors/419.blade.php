@extends('layouts.app')

@section('title', 'Page Expired')

@section('content')
<div class="flex flex-col items-center justify-center h-screen text-center bg-black text-white">
  <div id="star-layer"></div>
    <h1 class="text-6xl font-bold mb-4">404</h1>
    <h2 class="text-2xl mb-6">Oops! Your session has expired.</h2>
    <pre class="mb-6">Your session has timed out. Please try again.</pre>
    <a href="{{ url('/') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
        Go Home
    </a>
</div>
@endsection