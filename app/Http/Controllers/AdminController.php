<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // List all unverified students
    public function index()
    {
        // Get users who are NOT admins and NOT verified yet
        $users = User::where('role', '!=', 'admin')
            ->where('verified', false)
            ->get();

        // CHANGE THIS LINE: from 'admin.dashboard' to 'admin.index'
        return view('admin.index', compact('users'));
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
