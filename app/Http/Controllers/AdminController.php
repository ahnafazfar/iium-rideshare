<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // List all unverified students
    public function index()
    {
        // 1. Pending Users (For verification tab)
        $pending_users = User::where('role', '!=', 'admin')
            ->where('verified', false)
            ->get();

        // 2. All Users (For the new "All Users" tab)
        $all_users = User::where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.index', compact('pending_users', 'all_users'));
    }

    // Approve a student
    public function verify(User $user)
    {
        $user->update(['verified' => true]);
        return redirect()->back()->with('success', 'User verified successfully!');
    }

    // Reject/Delete a student
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('error', 'User rejected and deleted.');
    }
}
