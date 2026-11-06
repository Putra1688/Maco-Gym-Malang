<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Trainer;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)->get();
        $trainers = Trainer::where('is_active', true)->get();

        return view('guest.index', compact('packages', 'trainers'));
    }

    public function registerInterest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        // Store as pending member or send notification
        // Implementation depends on requirements

        return back()->with('success', 'Terima kasih! Kami akan menghubungi Anda segera.');
    }
}
