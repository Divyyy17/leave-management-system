<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Leave Requests
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto bg-white shadow rounded-lg p-6">

            <table class="w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">Leave Type</th>
                        <th class="border p-2">Start Date</th>
                        <th class="border p-2">End Date</th>
                        <th class="border p-2">Reason</th>
                        <th class="border p-2">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($leaves as $leave)
                        <tr>
                            <td class="border p-2">{{ $leave->leave_type }}</td>
                            <td class="border p-2">{{ $leave->start_date }}</td>
                            <td class="border p-2">{{ $leave->end_date }}</td>
                            <td class="border p-2">{{ $leave->reason }}</td>
                            <td class="border p-2">{{ $leave->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-4">
                                No leave requests found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>