<x-app-layout>
protected $fillable = [
    'user_id',
    'start_date',
    'end_date',
    'reason',
    'status',
];
<div class="p-6">

    <h2 class="text-xl font-bold mb-4">Apply Leave</h2>

    <form method="POST" action="{{ route('leave.store') }}">
        @csrf

        <div>
            <label>Start Date</label>
            <input type="date" name="start_date" required>
        </div>

        <div>
            <label>End Date</label>
            <input type="date" name="end_date" required>
        </div>

        <div>
            <label>Reason</label>
            <textarea name="reason" required></textarea>
        </div>

        <button type="submit">
            Submit
        </button>

    </form>

</div>

</x-app-layout>