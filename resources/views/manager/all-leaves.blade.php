<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Leave Requests
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto bg-white shadow rounded-lg p-6">

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

            <table class="w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">Employee</th>
                        <th class="border p-2">Leave Type</th>
                        <th class="border p-2">Start Date</th>
                        <th class="border p-2">End Date</th>
                        <th class="border p-2">Reason</th>
                        <th class="border p-2">Status</th>
                        <th class="border p-2">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($leaves as $leave)
                        <tr>
                            <td class="border p-2">{{ $leave->user->name }}</td>
                            <td class="border p-2">{{ $leave->leave_type }}</td>
                            <td class="border p-2">{{ $leave->start_date }}</td>
                            <td class="border p-2">{{ $leave->end_date }}</td>
                            <td class="border p-2">{{ $leave->reason }}</td>
                            <td class="border p-2">{{ $leave->status }}</td>

                            <td class="border p-2">
                                    @if($leave->status == 'Pending')

                                        <div class="flex items-center gap-2">

                                            <form action="{{ route('leave.approve', $leave->id) }}" method="POST">
                                                @csrf
                                            <button type="submit" style=background-color:#5eb55e
                                    class="!bg-green-500 !text-black px-3 py-1 rounded text-sm font-semibold hover:!bg-green-600">
                                    Approve
                                </button>
                                    </form>

                                    <form action="{{ route('leave.reject', $leave->id) }}" method="POST">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="inline-block bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700 transition">
                                            Reject
                                        </button>
                                    </form>

                                </div>

                                @else
                                    <span class="text-gray-500 text-sm">
                                        No Action
                                    </span>
                                @endif
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center p-4">
                                No leave requests found.
                            </td>
                        </tr>

                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>