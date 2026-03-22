<div class="p-6 bg-white shadow rounded-lg border border-gray-100">
    <div class="flex justify-between items-center cursor-pointer mb-4" onclick="toggleSection('customers')">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Customers</h2>
        <svg id="chevron-customers" class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>
    <table id="customers" class="hidden w-full text-left text-sm text-gray-600">
        <thead>
            <tr class="border-b">
                <th class="py-2 pr-4">Name</th>
                <th class="py-2 pr-4">Email</th>
                <th class="py-2 pr-4">Phone</th>
                <th class="py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $customer)
            <tr class="border-b" id="customer-row-{{ $customer->user_id }}">
                <td class="py-2 pr-4">{{ $customer->first_name }} {{ $customer->last_name }}</td>
                <td class="py-2 pr-4">{{ $customer->email }}</td>
                <td class="py-2 pr-4">{{ $customer->phone }}</td>
                <td class="py-2 flex gap-2">
                    <button onclick="openEditModal({{ $customer->user_id }}, '{{ $customer->first_name }}', '{{ $customer->last_name }}', '{{ $customer->email }}', '{{ $customer->phone }}')" class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        Edit
                    </button>
                    <form method="POST" action="{{ route('admin.customers.destroy', $customer->user_id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this customer and all their orders?')" class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="py-4 text-gray-400">No customers yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="editCustomerModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-semibold mb-4">Edit Customer</h2>
        <form id="editCustomerForm" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">First Name</label>
                    <input type="text" name="first_name" id="edit_first_name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Last Name</label>
                    <input type="text" name="last_name" id="edit_last_name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" id="edit_email" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Phone</label>
                    <input type="text" name="phone" id="edit_phone" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-blue-500">
                </div>
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">
                    Save
                </button>
                <button type="button" onclick="closeEditModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
