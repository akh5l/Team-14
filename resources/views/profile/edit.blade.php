@extends('layouts.app')

@section('content')
<main class="max-w-6xl mx-auto px-4 py-12">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Profile</h1>
        <div class="flex gap-3 mt-4 md:mt-0">
            <a href="/orders" class="w-full md:w-auto px-6 py-3 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-blue-700 transition transform hover:-translate-y-1">
                Order History
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full md:w-auto px-6 py-3 bg-red-600 text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-red-700 transition transform hover:-translate-y-1">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="space-y-6">
        <div class="p-6 bg-white shadow rounded-lg border border-gray-100">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-lg border border-gray-100">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-lg border border-gray-100">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</main>
@endsection