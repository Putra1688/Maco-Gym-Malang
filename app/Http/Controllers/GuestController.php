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

    public function registerInterest(Request $request): RedirectResponse
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

        $cleanPhone = preg_replace('/[^0-9]/', '', $validated['phone']);

        // Cegah pendaftaran ganda berdasarkan nomor telepon
        $existingMember = Member::where('phone', $validated['phone'])
            ->orWhere('phone', $cleanPhone)
            ->first();

        if ($existingMember) {
            if ($existingMember->status === 'active') {
                return back()->withInput()->with('warning', "Nomor telepon ({$validated['phone']}) sudah terdaftar sebagai Member Aktif (ID: {$existingMember->card_id}). Silakan lakukan perpanjangan membership atau hubungi admin.");
            }

            if ($existingMember->status === 'pending_verification') {
                $waMessage = "Halo Admin Maco Gym Malang, saya telah mendaftar online sebelumnya dengan ID Registrasi {$existingMember->card_id} atas nama {$existingMember->name}. Mohon dipandu untuk verifikasi pembayaran dan aktivasi kartu.";
                $waUrl = 'https://wa.me/6281250207403?text='.urlencode($waMessage);

                return back()->withInput()
                    ->with('info', "Pendaftaran atas nama {$existingMember->name} (ID: {$existingMember->card_id}) sudah tercatat di sistem kami dan sedang menunggu verifikasi resepsionis.")
                    ->with('wa_redirect_url', $waUrl)
                    ->with('registered_member_id', $existingMember->id);
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

        $member = DB::transaction(function () use ($regCardId, $validated, $genderEnum, $startDate) {
            return Member::create([
                'card_id' => $regCardId,
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'gender' => $genderEnum,
                'join_date' => $startDate,
                'current_expiry_date' => $startDate,
                'status' => 'pending_verification',
                'package_name' => $validated['package'],
            ]);
        });

        // Susun pesan WhatsApp untuk verifikasi kilat ke resepsionis
        $genderLabel = $genderEnum === 'male' ? 'Laki-laki' : ($genderEnum === 'female' ? 'Perempuan' : '-');
        $waMessage = "Halo Admin Maco Gym Malang, saya ingin mengonfirmasi pendaftaran member baru:\n\n"
            ."• *ID Registrasi:* {$member->card_id}\n"
            ."• *Nama Lengkap:* {$member->name}\n"
            ."• *No. WhatsApp:* {$member->phone}\n"
            ."• *Pilihan Paket:* {$validated['package']}\n"
            ."• *Jenis Kelamin:* {$genderLabel}\n"
            .'• *Alamat Domisili:* '.($validated['address'] ?? '-')."\n"
            ."• *Rencana Mulai:* {$startDate}\n"
            .(! empty($validated['notes']) ? "• *Catatan:* {$validated['notes']}\n\n" : "\n")
            .'Data pendaftaran saya telah tersimpan di sistem Maco Gym. Mohon dipandu untuk pembayaran QRIS dan pencetakan ID kartu fisik. Terima kasih!';

        $waUrl = 'https://wa.me/6281250207403?text='.urlencode($waMessage);

        return redirect()->route('register')
            ->with('success', "Pendaftaran Anda berhasil dicatat dengan ID Registrasi {$member->card_id}. Data telah tersimpan di sistem dan dapat diverifikasi di Admin Console.")
            ->with('wa_redirect_url', $waUrl)
            ->with('registered_member', $member);
    }
}
