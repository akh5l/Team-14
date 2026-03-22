<div class="p-6 bg-white shadow rounded-lg border border-gray-100">
    <div class="flex justify-between items-center cursor-pointer mb-4" onclick="toggleSection('orders')">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
            Orders
            @if($orders->where('order_status', 'processing')->count() > 0)
            <span class="text-sm bg-red-100 text-red-600 px-2 py-0.5 rounded-full">{{ $orders->where('order_status', 'processing')->count() }}</span>
            @endif
        </h2>
        <svg id="chevron-orders" class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>
    <table id="orders" class="w-full hidden text-left text-sm text-gray-600">
        <thead>
            <tr class="border-b">
                <th class="py-2 pr-4">Order</th>
                <th class="py-2 pr-4">Customer</th>
                <th class="py-2 pr-4">Email</th>
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
                <td class="py-2 pr-4">{{ $order->user->email }}</td>
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
                <td colspan="7" class="px-4 py-3">
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
                <td colspan="7" class="py-4 text-gray-400">No orders yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
