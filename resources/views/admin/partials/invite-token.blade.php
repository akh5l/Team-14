<div class="p-6 bg-white shadow rounded-lg border border-gray-100">
    <div class="flex justify-between items-center mb-4 cursor-pointer" onclick="toggleSection('invite-tokens'); toggleSection('generate-tokens-button')">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Invite Tokens</h2>
        @if(session('success'))
        <p class="mb-4 text-green-600 font-medium">{{ session('success') }}</p>
        @endif
        <form class="ml-auto mr-6" method="POST" action="{{ route('admin.invite.generate') }}">
            @csrf
            <button type="submit" id="generate-tokens-button" class="hidden px-6 py-3 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-blue-700 transition transform hover:-translate-y-1">
                Generate Token
            </button>
        </form>
        <svg id="chevron-invite-tokens" class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>
    <table id="invite-tokens" class="w-full hidden text-left text-sm text-gray-600">
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
