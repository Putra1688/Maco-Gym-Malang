<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class GuestController extends Controller
{
    public function index()
    {
        try {
            $packages = Schema::hasTable('packages') ? Package::where('is_active', true)->get() : collect();
        } catch (\Throwable $e) {
            $packages = collect();
        }

        return view('welcome', compact('packages'));
    }

    public function registerInterest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
        ]);

        return back()->with('success', 'Terima kasih! Kami akan menghubungi Anda segera.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
        ]);

        return redirect()->route('register')->with('success', 'Pendaftaran Anda telah kami terima. Resepsionis Maco Gym akan segera memverifikasi via WhatsApp.');
    }
}
