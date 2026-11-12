<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\Package;
use App\Models\User;
use Tests\TestCase;

class FinalTaskImprovementTest extends TestCase
{
    /**
     * 1. 3 Kategori utama pricing di landing page & kesesuaian harga pada halaman detail resmi.
     */
    public function test_pricing_section_contains_all_poster_prices_and_categories(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Landing page menampilkan 3 kategori utama dan tautan detail
        $response->assertSee('MEMBERSHIP');
        $response->assertSee('PERSONAL TRAINER SINGLE');
        $response->assertSee('PERSONAL TRAINER COUPLES');
        $response->assertSee(route('pricing.membership'));
        $response->assertSee(route('pricing.pt-single'));
        $response->assertSee(route('pricing.pt-couples'));
        $response->assertSee('LIHAT DETAIL PAKET');

        // A. Detail Page: Membership Official Prices
        $membershipRes = $this->get(route('pricing.membership'));
        $membershipRes->assertStatus(200);
        $membershipRes->assertSee('Rp 30.000'); // Insidentil
        $membershipRes->assertSee('Rp 20.000'); // Regular Membership
        $membershipRes->assertSee('Rp 130.000'); // 1 Month
        $membershipRes->assertSee('Rp 375.000'); // 3 Month
        $membershipRes->assertSee('Rp 750.000'); // 6 Month
        $membershipRes->assertSee('Rp 1.450.000'); // 12 Month
        $membershipRes->assertSee('Rp 100.000'); // Pelajar
        $membershipRes->assertSee('Rp 110.000'); // Mahasiswa

        // B. Detail Page: Personal Trainer - Single Session Prices
        $ptSingleRes = $this->get(route('pricing.pt-single'));
        $ptSingleRes->assertStatus(200);
        $ptSingleRes->assertSee('Rp 130.000'); // 1 PT
        $ptSingleRes->assertSee('Rp 550.000'); // 4 PT (10 hari)
        $ptSingleRes->assertSee('Rp 950.000'); // 8 PT (20 hari)
        $ptSingleRes->assertSee('Rp 1.150.000'); // 12 PT (30 hari)
        $ptSingleRes->assertSee('Rp 1.450.000'); // 16 PT (40 hari)
        $ptSingleRes->assertSee('Rp 1.850.000'); // 20 PT (50-60 hari)
        $ptSingleRes->assertSee('Durasi latihan 1–1,5 jam per kedatangan');

        // C. Detail Page: Personal Trainer - Couples Session Prices
        $ptCouplesRes = $this->get(route('pricing.pt-couples'));
        $ptCouplesRes->assertStatus(200);
        $ptCouplesRes->assertSee('Rp 210.000'); // 1 PT Couples
        $ptCouplesRes->assertSee('Rp 950.000'); // 4 PT Couples (15 hari)
        $ptCouplesRes->assertSee('Rp 1.200.000'); // 8 PT Couples (30 hari)
        $ptCouplesRes->assertSee('Rp 1.850.000'); // 12 PT Couples (30 hari)
        $ptCouplesRes->assertSee('Rp 2.150.000'); // 16 PT Couples (40 hari)
        $ptCouplesRes->assertSee('Rp 2.650.000'); // 20 PT Couples (60 hari)
        $ptCouplesRes->assertSee('Durasi latihan 1–1,5 jam per kedatangan');
    }

    /**
     * 4. Tombol Daftar Sekarang & 5. Penyimpanan data pendaftaran ke DB & Admin Console.
     */
    public function test_online_registration_saves_to_database_and_is_visible_to_admin(): void
    {
        $uniquePhone = '0812'.rand(10000000, 99999999);
        $candidateName = 'Calon Member Online Test';

        // 1. Kirim pendaftaran online
        $response = $this->post(route('guest.register'), [
            'name' => $candidateName,
            'phone' => $uniquePhone,
            'package' => '1 Month - Rp 130.000',
            'gender' => 'Laki-laki',
            'address' => 'Jl. Soekarno Hatta Malang',
            'start_date' => today()->toDateString(),
            'notes' => 'Ingin program pembentukan otot dada',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertSessionHas('success');
        $response->assertSessionHas('wa_redirect_url');

        // 2. Pastikan data calon member tersimpan di database dengan status pending_verification
        $this->assertDatabaseHas('members', [
            'name' => $candidateName,
            'phone' => $uniquePhone,
            'gender' => 'male',
            'status' => 'pending_verification',
        ]);

        $member = Member::where('phone', $uniquePhone)->first();
        $this->assertNotNull($member);
        $this->assertStringStartsWith('REG-', $member->card_id);

        // 3. Pastikan Admin Console dapat melihat data pendaftaran ini
        $admin = User::where('role', 'admin')->first();
        $adminListResponse = $this->actingAs($admin)->get(route('admin.members.index', ['status' => 'pending_verification']));
        $adminListResponse->assertStatus(200);
        $adminListResponse->assertSee($candidateName);
        $adminListResponse->assertSee($member->card_id);

        // 4. Uji pencegahan pendaftaran ganda dengan nomor telepon yang sama
        $duplicateResponse = $this->post(route('guest.register'), [
            'name' => 'Nama Lain Nomor Sama',
            'phone' => $uniquePhone,
            'package' => '3 Month - Rp 375.000',
            'gender' => 'Perempuan',
            'address' => 'Malang',
        ]);

        $duplicateResponse->assertSessionHas('info');
        // Pastikan tidak ada data baru yang dibuat
        $this->assertEquals(1, Member::where('phone', $uniquePhone)->count());
    }

    /**
     * 6. Transaksi tiket tamu harian di Frontdesk.
     */
    public function test_daily_guest_ticket_transaction_and_attendance(): void
    {
        $admin = User::where('role', 'admin')->first();
        $dailyPackage = Package::where('type', 'daily_visit')->first();

        $guestName = 'Tamu Visit Kasir '.uniqid();
        $response = $this->actingAs($admin)->post(route('admin.frontdesk.daily-guest'), [
            'name' => $guestName,
            'phone' => '0855555555',
            'package_id' => $dailyPackage->id,
            'payment_method' => 'qris',
            'notes' => 'Tiket latihan sore',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Pastikan transaksi tercatat
        $this->assertDatabaseHas('transactions', [
            'package_id' => $dailyPackage->id,
            'customer_name' => $guestName,
            'payment_method' => 'qris',
            'amount' => $dailyPackage->price,
        ]);

        // Pastikan presensi tamu harian tercatat
        $this->assertDatabaseHas('attendances', [
            'type' => 'daily_guest',
            'guest_name' => $guestName,
        ]);
    }

    /**
     * 7. Pendaftaran member baru Walk-in di Meja Kasir.
     */
    public function test_walk_in_member_registration_with_immediate_checkin(): void
    {
        $admin = User::where('role', 'admin')->first();
        $package = Package::where('type', 'membership')->first();
        $uniqueCardId = 'MC-WALK-'.rand(100, 999);
        $uniquePhone = '0877'.rand(10000000, 99999999);
        $walkinName = 'Member Walkin Langsung Latihan';

        $response = $this->actingAs($admin)->post(route('admin.members.store'), [
            'card_id' => $uniqueCardId,
            'name' => $walkinName,
            'phone' => $uniquePhone,
            'gender' => 'male',
            'package_id' => $package->id,
            'payment_method' => 'cash',
            'checkin_now' => '1',
        ]);

        $response->assertRedirect(route('admin.members.index'));
        $response->assertSessionHas('success');

        // Pastikan member aktif
        $this->assertDatabaseHas('members', [
            'card_id' => $uniqueCardId,
            'name' => $walkinName,
            'status' => 'active',
        ]);

        // Pastikan presensi langsung tercatat
        $member = Member::where('card_id', $uniqueCardId)->first();
        $this->assertDatabaseHas('attendances', [
            'type' => 'member',
            'member_id' => $member->id,
        ]);

        // Pastikan transaksi tercatat
        $this->assertDatabaseHas('transactions', [
            'member_id' => $member->id,
            'package_id' => $package->id,
            'payment_method' => 'cash',
        ]);
    }

    /**
     * 9. Perpanjangan member aktif (akumulasi sisa hari) & 10. Perpanjangan member kedaluwarsa.
     */
    public function test_renewal_calculation_rules_active_and_expired(): void
    {
        $admin = User::where('role', 'admin')->first();
        $package = Package::where('type', 'membership')->where('duration_days', 30)->first()
            ?? Package::where('type', 'membership')->first();

        // Kasus A: Member Aktif dengan sisa masa aktif (misal masih berlaku 15 hari ke depan)
        $futureExpiry = today()->addDays(15);
        $activeMember = Member::create([
            'card_id' => 'MC-TEST-ACT-'.rand(100, 999),
            'name' => 'Member Aktif Uji Perpanjang',
            'phone' => '0813'.rand(10000000, 99999999),
            'join_date' => today()->subDays(15)->toDateString(),
            'current_expiry_date' => $futureExpiry->toDateString(),
            'status' => 'active',
        ]);

        $this->actingAs($admin)->post(route('admin.members.renew', $activeMember), [
            'package_id' => $package->id,
            'payment_method' => 'transfer',
        ]);

        $activeMember->refresh();
        $expectedActiveExpiry = $futureExpiry->copy()->addDays($package->duration_days)->toDateString();
        $this->assertEquals($expectedActiveExpiry, $activeMember->current_expiry_date->toDateString(), 'Sisa hari aktif harus diakumulasikan');
        $this->assertEquals('active', $activeMember->status);

        // Kasus B: Member Kedaluwarsa (misal sudah expired 10 hari yang lalu)
        $pastExpiry = today()->subDays(10);
        $expiredMember = Member::create([
            'card_id' => 'MC-TEST-EXP-'.rand(100, 999),
            'name' => 'Member Expired Uji Perpanjang',
            'phone' => '0814'.rand(10000000, 99999999),
            'join_date' => today()->subDays(40)->toDateString(),
            'current_expiry_date' => $pastExpiry->toDateString(),
            'status' => 'expired',
        ]);

        $this->actingAs($admin)->post(route('admin.members.renew', $expiredMember), [
            'package_id' => $package->id,
            'payment_method' => 'cash',
        ]);

        $expiredMember->refresh();
        $expectedExpiredExpiry = today()->addDays($package->duration_days)->toDateString();
        $this->assertEquals($expectedExpiredExpiry, $expiredMember->current_expiry_date->toDateString(), 'Member kedaluwarsa harus dihitung dari tanggal transaksi saat ini');
        $this->assertEquals('active', $expiredMember->status);
    }
}
