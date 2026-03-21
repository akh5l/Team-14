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
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Invite Tokens</h2>
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
        <div class="p-6 bg-white shadow rounded-lg border border-gray-100">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Orders</h2>
            <table class="w-full text-left text-sm text-gray-600">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 pr-4">Order</th>
                        <th class="py-2 pr-4">Customer</th>
                        <th class="py-2 pr-4">Date</th>
                        <th class="py-2 pr-4">Status</th>
                        <th class="py-2 pr-4">Total</th>
                        <th class="py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr class="border-b cursor-pointer hover:bg-gray-50" onclick="toggleItems({{ $order->order_id }})">
                        <td class="py-2 pr-4 flex items-center gap-4">#{{ $order->order_id }}<svg id="chevron-{{ $order->order_id }}" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg></td>
                        <td class="py-2 pr-4">{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                        <td class="py-2 pr-4">{{ $order->order_date->format('d M Y') }}</td>
                        <td class="py-2 pr-4">{{ ucfirst($order->order_status) }}</td>
                        <td class="py-2 pr-4">£{{ number_format($order->total_amount, 2) }}</td>
                        <td class="py-2">
                            @if($order->order_status !== 'delivered')
                            <form method="POST" action="{{ route('orders.process', $order->order_id) }}" onclick="event.stopPropagation()">
                                @csrf
                                <button type="submit" onclick="return confirm('Process this order?')" class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                                    Process
                                </button>
                            </form>
                            @else
                            <span class="text-gray-400 text-sm">Delivered</span>
                            @endif
                        </td>
                    </tr>
                    <tr id="items-{{ $order->order_id }}" class="hidden bg-gray-50">
                        <td colspan="6" class="px-4 py-3">
                            <table class="w-full text-sm">
                                @foreach($order->items as $item)
                                <tr class="border-b border-gray-100 last:border-0">
                                    <td class="py-1 w-1/3">{{ $item->product ? $item->product->product_name : 'Product unavailable' }}</td>
                                    <td class="py-1 w-1/4 text-gray-500">Qty: {{ $item->quantity }}</td>
                                    <td class="py-1 w-1/4 text-gray-500">£{{ number_format($item->price, 2) }} each</td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-4 text-gray-400">No orders yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    function toggleItems(orderId) {
        const row = document.getElementById('items-' + orderId);
        row.classList.toggle('hidden');
    }

</script>
@endsection
