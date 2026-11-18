<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class GuestController extends Controller
{
    public function index(): View
    {
        try {
            $packages = Schema::hasTable('packages') ? Package::where('is_active', true)->get() : collect();
        } catch (\Throwable $e) {
            $packages = collect();
        }

        return view('welcome', compact('packages'));
    }

    public function showRegister(Request $request): View
    {
        return view('guest.register');
    }

    public function pricingMembership(): View
    {
        return view('guest.pricing.membership');
    }

    public function pricingPtSingle(): View
    {
        return view('guest.pricing.pt-single');
    }

    public function pricingPtCouples(): View
    {
        return view('guest.pricing.pt-couples');
    }

    public function facilities()
    {
        return view('guest.facilities');
    }

    public function registerInterest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
        ]);

        return back()->with('success', 'Terima kasih! Kami akan menghubungi Anda segera.');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
            'package' => 'required|string|max:255',
            'gender' => 'nullable|string|in:male,female,Laki-laki,Perempuan',
            'address' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'notes' => 'nullable|string|max:500',
        ]);

        $rawPhone = trim($validated['phone']);
        $cleanPhone = preg_replace('/[^0-9]/', '', $rawPhone);

        // Validasi paket resmi: Hanya paket Membership yang diperbolehkan untuk registrasi
        $pkgLower = strtolower($validated['package']);
        $isForbidden = str_contains($pkgLower, 'pt')
            || str_contains($pkgLower, 'personal trainer')
            || str_contains($pkgLower, 'insidentil')
            || str_contains($pkgLower, 'daily pass')
            || str_contains($pkgLower, 'joining fee')
            || str_contains($pkgLower, 'regular membership');

        $isValidMembership = str_contains($pkgLower, '1 month')
            || str_contains($pkgLower, '3 month')
            || str_contains($pkgLower, '6 month')
            || str_contains($pkgLower, '12 month')
            || str_contains($pkgLower, 'mahasiswa')
            || str_contains($pkgLower, 'pelajar');

        if ($isForbidden || ! $isValidMembership) {
            return back()->withInput()->withErrors([
                'package' => 'Pilihan paket tidak valid. Registrasi online hanya melayani paket Membership resmi (1 Month, 3 Month, 6 Month, 12 Month, Mahasiswa, Pelajar). Layanan Personal Trainer dan tiket harian diproses langsung melalui Admin.',
            ]);
        }

        // Cegah pendaftaran ganda berdasarkan nomor telepon
        $existingMember = Member::where('phone', $validated['phone'])
            ->orWhere('phone', $cleanPhone)
            ->first();

        if ($existingMember) {
            if ($existingMember->status === 'active') {
                return back()->withInput()->with('warning', "Nomor HP ({$rawPhone}) sudah terdaftar sebagai Member Aktif (ID: {$existingMember->card_id}). Silakan lakukan login atau perpanjangan membership langsung di resepsionis.");
            }

            if ($existingMember->status === 'pending_verification') {
                return back()->withInput()
                    ->with('info', "Pendaftaran dengan nomor HP ({$rawPhone}) atas nama {$existingMember->name} sudah tercatat di sistem (ID: {$existingMember->card_id}) dan sedang menunggu verifikasi oleh kasir/admin.")
                    ->with('registered_member', [
                        'card_id' => $existingMember->card_id,
                        'phone' => $existingMember->phone,
                        'package_name' => $existingMember->package_name ?? 'Regular',
                    ]);
            }
        }

        // Tentukan nilai gender yang kompatibel dengan enum members (male/female)
        $genderEnum = null;
        if (! empty($validated['gender'])) {
            $gLower = strtolower($validated['gender']);
            if (in_array($gLower, ['male', 'laki-laki', 'l'])) {
                $genderEnum = 'male';
            } elseif (in_array($gLower, ['female', 'perempuan', 'p'])) {
                $genderEnum = 'female';
            }
        }

        $startDate = ! empty($validated['start_date'])
            ? Carbon::parse($validated['start_date'])->toDateString()
            : today()->toDateString();

        // Generate ID registrasi unik sementara (misal: REG-261109-8421)
        do {
            $regCardId = 'REG-'.now()->format('ymd').'-'.strtoupper(substr(uniqid(), -4));
        } while (Member::where('card_id', $regCardId)->exists());

        $member = DB::transaction(function () use ($regCardId, $validated, $rawPhone, $genderEnum, $startDate) {
            $memberData = [
                'card_id' => $regCardId,
                'name' => $validated['name'],
                'phone' => $rawPhone,
                'gender' => $genderEnum,
                'join_date' => $startDate,
                'current_expiry_date' => $startDate,
                'status' => 'pending_verification',
            ];

            try {
                if (Schema::hasColumn('members', 'package_name')) {
                    $memberData['package_name'] = $validated['package'];
                }
            } catch (\Throwable $e) {
                // Skema tanpa kolom package_name tetap aman
            }

            return Member::create($memberData);
        });

        return redirect()->route('register')
            ->with('success', "Pendaftaran Anda berhasil! Data telah masuk ke sistem Maco Gym (ID Registrasi: {$member->card_id}) dan berstatus Menunggu Verifikasi Admin. Silakan kunjungi meja kasir/resepsionis untuk verifikasi dan aktivasi kartu fisik.")
            ->with('registered_member', [
                'card_id' => $member->card_id,
                'phone' => $member->phone,
                'package_name' => $member->package_name ?? $validated['package'] ?? 'Regular',
            ]);
    }
}
