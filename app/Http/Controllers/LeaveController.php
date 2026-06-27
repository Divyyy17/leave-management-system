<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    // Show Apply Leave form
    public function create()
    {
        return view('leave.apply');
    }

    // Store Leave Request
    public function store(Request $request)
    {
        $request->validate([
            'leave_type' => 'required',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required'
        ]);

        // overlap check
        $overlap = LeaveRequest::where('user_id', Auth::id())
            ->whereIn('status', ['Pending', 'Approved'])
            ->where(function ($query) use ($request) {
                $query->where('start_date', '<=', $request->end_date)
                      ->where('end_date', '>=', $request->start_date);
            })
            ->exists();

        if ($overlap) {
            return back()->with('error', 'You already applied for these dates.');
        }

        LeaveRequest::create([
            'user_id' => Auth::id(),
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'Pending'
        ]);

        return redirect()->route('leave.my')
            ->with('success', 'Leave applied successfully.');
    }

    // Employee leaves
    public function myLeaves()
    {
        $leaves = LeaveRequest::where('user_id', Auth::id())->get();

        return view('leave.my-leaves', compact('leaves'));
    }

    // Manager view
    public function allLeaves()
    {
        $leaves = LeaveRequest::with('user')->get();

        return view('manager.all-leaves', compact('leaves'));
    }

    // Approve
    public function approve($id)
    {
        $leave = LeaveRequest::findOrFail($id);

        if ($leave->status !== 'Pending') {
            return back()->with('error', 'Already processed');
        }

        $leave->update(['status' => 'Approved']);

        return back()->with('success', 'Approved');
    }

    // Reject
    public function reject($id)
    {
        $leave = LeaveRequest::findOrFail($id);

        if ($leave->status !== 'Pending') {
            return back()->with('error', 'Already processed');
        }

        $leave->update(['status' => 'Rejected']);

        return back()->with('success', 'Rejected');
    }
}