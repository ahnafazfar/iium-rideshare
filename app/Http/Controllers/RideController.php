<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ride;

class RideController extends Controller
{
    public function index()
    {
        // Load rides with user info for performance
        $rides = Ride::latest()->with('user')->get();

        // Return the dashboard view instead of rides.index
        return view('dashboard', compact('rides'));
    }

    public function create()
    {
        // Optional: Block unverified users from accessing the form
        if (!auth()->user()->verified) {
            return redirect()->route('dashboard')->with('error', 'You must be verified to post a ride.');
        }

        return view('rides.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pickup' => 'required',
            'dropoff' => 'required',
            'time' => 'required',
        ]);

        Ride::create([
            'pickup' => $request->pickup,
            'dropoff' => $request->dropoff,
            'time' => $request->time,
            'user_id' => auth()->id(),
        ]);

        // FIX: Redirect to 'dashboard' instead of 'rides.index'
        return redirect()->route('dashboard')->with('success', 'Ride order created successfully!');
    }

    public function destroy(Ride $ride)
    {
        // Allow Admins or the Owner to delete
        if (auth()->id() !== $ride->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $ride->delete();

        // FIX: Redirect to 'dashboard'
        return redirect()->route('dashboard')->with('success', 'Ride deleted successfully.');
    }
}
