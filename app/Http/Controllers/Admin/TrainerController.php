<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TrainerController extends Controller
{
    public function index(): View
    {
        $trainers = Trainer::orderBy('is_active', 'desc')->orderBy('name', 'asc')->get();

        return view('admin.trainers.index', compact('trainers'));
    }

    public function create(): View
    {
        return view('admin.trainers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'phone' => 'nullable|string|max:25',
            'photo' => 'nullable|image|max:2048',
            'is_active' => 'sometimes|boolean',
        ]);

        $data = [
            'name' => $request->name,
            'specialty' => $request->specialty,
            'phone' => $request->phone,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('trainers', 'public');
        }

        Trainer::create($data);

        return redirect()->route('admin.trainers.index')
            ->with('success', "Personal Trainer '{$request->name}' berhasil ditambahkan.");
    }

    public function edit(Trainer $trainer): View
    {
        return view('admin.trainers.edit', compact('trainer'));
    }

    public function update(Request $request, Trainer $trainer): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'phone' => 'nullable|string|max:25',
            'photo' => 'nullable|image|max:2048',
            'is_active' => 'sometimes|boolean',
        ]);

        $data = [
            'name' => $request->name,
            'specialty' => $request->specialty,
            'phone' => $request->phone,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('photo')) {
            if ($trainer->photo_path && Storage::disk('public')->exists($trainer->photo_path)) {
                Storage::disk('public')->delete($trainer->photo_path);
            }
            $data['photo_path'] = $request->file('photo')->store('trainers', 'public');
        }

        $trainer->update($data);

        return redirect()->route('admin.trainers.index')
            ->with('success', "Data Trainer '{$trainer->name}' berhasil diperbarui.");
    }

    public function destroy(Trainer $trainer): RedirectResponse
    {
        $name = $trainer->name;
        if ($trainer->photo_path && Storage::disk('public')->exists($trainer->photo_path)) {
            Storage::disk('public')->delete($trainer->photo_path);
        }
        $trainer->delete();

        return redirect()->route('admin.trainers.index')
            ->with('success', "Trainer '{$name}' telah dihapus.");
    }
}
