@extends('layouts.app')
@section('content')
<main class="max-w-6xl mx-auto px-4 py-12">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Admin Dashboard</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-6 py-3 bg-red-600 text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-red-700 transition transform hover:-translate-y-1">
                Logout
            </button>
        </form>
    </div>

    <div class="space-y-6">
        <div class="p-6 bg-white shadow rounded-lg border border-gray-100">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Generate Invite Token</h2>
            @if(session('success'))
            <p class="mb-4 text-green-600 font-medium">{{ session('success') }}</p>
            @endif
            <form method="POST" action="{{ route('admin.invite.generate') }}">
                @csrf
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-blue-700 transition transform hover:-translate-y-1">
                    Generate Token
                </button>
            </form>
        </div>

        <div class="p-6 bg-white shadow rounded-lg border border-gray-100">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Invite Tokens</h2>
            <table class="w-full text-left text-sm text-gray-600">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 pr-4">Token</th>
                        <th class="py-2 pr-4">Status</th>
                        <th class="py-2 pr-4">Expires At</th>
                        <th class="py-2">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invites as $invite)
                    <tr class="border-b">
                        <td class="py-2 pr-4">{{ $invite->token }}</td>
                        <td class="py-2 pr-4">
                            @if($invite->used)
                            <span class="text-gray-400">Used</span>
                            @elseif($invite->isExpired())
                            <span class="text-red-500">Expired</span>
                            @else
                            <span class="text-green-600">Valid</span>
                            @endif
                        </td>
                        <td class="py-2 pr-4">{{ $invite->expires_at->format('d M Y, H:i') }}</td>
                        <td class="py-2">{{ $invite->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 text-gray-400">No tokens generated yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection
