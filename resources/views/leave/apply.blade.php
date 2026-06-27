<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Apply Leave
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('leave.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1">Leave Type</label>

                    <select name="leave_type" class="w-full border rounded p-2">
                        <option value="">Select Leave Type</option>
                        <option value="Casual">Casual Leave</option>
                        <option value="Sick">Sick Leave</option>
                        <option value="Earned">Earned Leave</option>
                    </select>

                    @error('leave_type')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Start Date</label>

                    <input
                        type="date"
                        name="start_date"
                        class="w-full border rounded p-2"
                    >

                    @error('start_date')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">End Date</label>

                    <input
                        type="date"
                        name="end_date"
                        class="w-full border rounded p-2"
                    >

                    @error('end_date')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Reason</label>

                    <textarea
                        name="reason"
                        rows="4"
                        class="w-full border rounded p-2"
                    ></textarea>

                    @error('reason')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

               <x-primary-button>
    Apply Leave
</x-primary-button>
            </form>

        </div>
    </div>
</x-app-layout>