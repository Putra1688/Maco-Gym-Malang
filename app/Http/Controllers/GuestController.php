<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class GuestController extends Controller
{
    public function index()
    {
        try {
            $packages = Schema::hasTable('packages') ? Package::where('is_active', true)->get() : collect();
            $trainers = Schema::hasTable('trainers') ? Trainer::where('is_active', true)->get() : collect();
        } catch (\Throwable $e) {
            $packages = collect();
            $trainers = collect();
        }

        return view('welcome', compact('packages', 'trainers'));
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
