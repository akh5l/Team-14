@extends('layouts.app')
@section('content')
    <main class="max-w-6xl mx-auto px-4 py-12">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Admin Dashboard</h1>
            <div class="flex gap-3 mt-4 md:mt-0">
                <button action="{{ route('admin.inventory') }}"
                    class="w-full md:w-auto px-6 py-3 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-blue-700 transition transform hover:-translate-y-1">
                    Inventory Management
                </button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-6 py-3 bg-red-600 text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-red-700 transition transform hover:-translate-y-1">
                        Logout
                    </button>
                </form>
            </div>
        </div>
        <div class="space-y-6">
            @include('admin.partials.invite-token')
            @include('admin.partials.order-process')
            @include('admin.partials.customer-info')
        </div>
    </main>

    <script>
        function toggleItems(orderId) {
            const row = document.getElementById('items-' + orderId);
            const chevron = document.getElementById('chevron-' + orderId);
            row.classList.toggle('hidden');
            chevron.classList.toggle('rotate-180');
        }

        function toggleSection(id) {
            const section = document.getElementById(id);
            const chevron = document.getElementById('chevron-' + id);
            section.classList.toggle('hidden');
            chevron.classList.toggle('rotate-180');
        }

        function openEditModal(id, firstName, lastName, email, phone) {
            document.getElementById('edit_first_name').value = firstName;
            document.getElementById('edit_last_name').value = lastName;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_phone').value = phone;
            document.getElementById('editCustomerForm').action = '/admin/customers/' + id;
            document.getElementById('editCustomerModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editCustomerModal').classList.add('hidden');
        }
    </script>
@endsection
