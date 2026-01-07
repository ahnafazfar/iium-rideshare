<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ride;

class RideController extends Controller
{
    public function index()
    {
        $rides = Ride::latest()->get();
        return view('rides.index', compact('rides'));
    }

    public function create()
    {
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

        return redirect()->route('rides.index');
    }

    public function destroy(Ride $ride)
    {
        if ($ride->user_id !== auth()->id()) {
            abort(403);
        }
        $ride->delete();
        return back();
    }
}
