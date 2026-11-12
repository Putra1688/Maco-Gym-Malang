<?php

namespace Tests\Feature;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\User;
use Tests\TestCase;

class PendingMemberDashboardMonitoringTest extends TestCase
{
    /**
     * Skenario 1, 3, 4, 5:
     * - Member mendaftar melalui Landing Page.
     * - Data tersimpan dengan status Pending dan paket yang dipilih tercatat.
     * - Member Pending langsung muncul pada section "PENDAFTARAN MEMBER BARU" di Dashboard Monitoring.
     * - Member Pending TIDAK dihitung sebagai Member Aktif.
     */
    public function test_landing_page_registration_saves_as_pending_and_displays_on_dashboard(): void
    {
        $admin = User::where('role', 'admin')->first();
        $uniquePhone = '0819'.rand(10000000, 99999999);
        $candidateName = 'Calon Member Online Audit '.uniqid();
        $selectedPackage = '3 Month - Rp 375.000';

        // 1. Member mendaftar melalui Landing Page
        $response = $this->post(route('guest.register'), [
            'name' => $candidateName,
            'phone' => $uniquePhone,
            'package' => $selectedPackage,
            'gender' => 'Laki-laki',
            'address' => 'Jl. Ijen No. 12 Malang',
            'start_date' => today()->toDateString(),
            'notes' => 'Latihan sore',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertSessionHas('success');

        // 3. Data tersimpan dengan status Pending
        $this->assertDatabaseHas('members', [
            'name' => $candidateName,
            'phone' => $uniquePhone,
            'status' => 'pending_verification',
            'package_name' => $selectedPackage,
        ]);

        $member = Member::where('phone', $uniquePhone)->first();
        $this->assertNotNull($member);

        // 4. Member Pending langsung muncul pada Dashboard Monitoring
        $dashboardResponse = $this->actingAs($admin)->get(route('admin.dashboard'));
        $dashboardResponse->assertStatus(200);

        // Memastikan section PENDAFTARAN MEMBER BARU ada di Dashboard
        $dashboardResponse->assertSee('PENDAFTARAN MEMBER BARU');
        $dashboardResponse->assertSee($member->card_id);
        $dashboardResponse->assertSee($candidateName);
        $dashboardResponse->assertSee($uniquePhone);
        $dashboardResponse->assertSee($selectedPackage);
        $dashboardResponse->assertSee('PENDING');
        $dashboardResponse->assertSee('Detail');
        $dashboardResponse->assertSee('Verifikasi');
        $dashboardResponse->assertSee(route('admin.members.index', ['status' => 'pending_verification']));

        // 5. Member Pending tidak dihitung sebagai Member Aktif
        $activeMembersCount = Member::where('status', 'active')
            ->where('current_expiry_date', '>=', today()->toDateString())
            ->count();

        // Pastikan view variable totalActiveMembers cocok dengan activeMembersCount murni
        $dashboardResponse->assertViewHas('totalActiveMembers', $activeMembersCount);
        $this->assertFalse($member->isActive());

        // Cleanup
        $member->delete();
    }

    /**
     * Skenario 2 & 3:
     * - Member mendaftar melalui Admin Console dengan status Pending.
     * - Data tersimpan dengan status Pending tanpa transaksi awal.
     * - Langsung terlihat di Dashboard Monitoring.
     */
    public function test_admin_console_registration_as_pending_appears_on_dashboard(): void
    {
        $admin = User::where('role', 'admin')->first();
        $package = Package::where('type', 'membership')->first();
        $uniqueCardId = 'REG-ADM-'.rand(1000, 9999);
        $uniquePhone = '0818'.rand(10000000, 99999999);
        $candidateName = 'Calon Member Walk-in Pending '.uniqid();

        // 2. Member mendaftar melalui Admin Console dengan opsi pending_verification
        $response = $this->actingAs($admin)->post(route('admin.members.store'), [
            'card_id' => $uniqueCardId,
            'name' => $candidateName,
            'phone' => $uniquePhone,
            'gender' => 'female',
            'status' => 'pending_verification',
            'package_id' => $package->id,
            'payment_method' => 'cash',
        ]);

        $response->assertRedirect(route('admin.members.index'));
        $response->assertSessionHas('success');

        // 3. Tersimpan dengan status pending_verification dan BELUM ada transaksi kas
        $member = Member::where('card_id', $uniqueCardId)->first();
        $this->assertNotNull($member);
        $this->assertEquals('pending_verification', $member->status);
        $this->assertEquals($package->name, $member->package_name);
        $this->assertEquals(0, Transaction::where('member_id', $member->id)->count());

        // 4. Langsung terlihat di Dashboard Monitoring
        $dashboardResponse = $this->actingAs($admin)->get(route('admin.dashboard'));
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee($uniqueCardId);
        $dashboardResponse->assertSee($candidateName);
        $dashboardResponse->assertSee($package->name);

        // Cleanup
        if ($member->user) {
            $member->user->delete();
        }
        $member->delete();
    }

    /**
     * Skenario 6, 7, 8, 9:
     * - Admin membuka detail pendaftaran member pending.
     * - Admin melakukan verifikasi pembayaran.
     * - Status berubah menjadi Active, masa aktif dihitung sesuai paket.
     * - Transaksi kas resmi tercatat.
     * - Member muncul pada daftar member aktif dan hilang dari daftar Pending.
     */
    public function test_verification_flow_activates_pending_member_and_records_transaction(): void
    {
        $admin = User::where('role', 'admin')->first();
        $package = Package::where('type', 'membership')->where('duration_days', 30)->first()
            ?? Package::where('type', 'membership')->first();

        // Siapkan calon member status pending
        $tempRegId = 'REG-VERIF-'.rand(1000, 9999);
        $physicalCardId = 'MC-PHY-'.rand(1000, 9999);
        $phone = '0821'.rand(10000000, 99999999);
        $name = 'Member Siap Verifikasi '.uniqid();

        $member = Member::create([
            'card_id' => $tempRegId,
            'name' => $name,
            'phone' => $phone,
            'gender' => 'male',
            'join_date' => today()->toDateString(),
            'current_expiry_date' => today()->toDateString(),
            'status' => 'pending_verification',
            'package_name' => $package->name,
        ]);

        // 6. Admin membuka detail pendaftaran
        $showResponse = $this->actingAs($admin)->get(route('admin.members.show', $member));
        $showResponse->assertStatus(200);
        $showResponse->assertSee($tempRegId);
        $showResponse->assertSee('Verifikasi & Aktivasi Member', false);
        $showResponse->assertSee('Pendaftaran Menunggu Verifikasi Pembayaran & Aktivasi', false);

        // 7. Admin melakukan verifikasi
        $verifyResponse = $this->actingAs($admin)->post(route('admin.members.verify', $member), [
            'card_id' => $physicalCardId,
            'package_id' => $package->id,
            'payment_method' => 'qris',
            'checkin_now' => '1',
        ]);

        $verifyResponse->assertRedirect(route('admin.members.show', $member));
        $verifyResponse->assertSessionHas('success');

        // 8. Status berubah sesuai proses aktivasi
        $member->refresh();
        $this->assertEquals('active', $member->status);
        $this->assertEquals($physicalCardId, $member->card_id);
        $expectedExpiry = today()->addDays($package->duration_days)->toDateString();
        $this->assertEquals($expectedExpiry, $member->current_expiry_date->toDateString());

        // Transaksi pembayaran kas resmi tercatat
        $this->assertDatabaseHas('transactions', [
            'member_id' => $member->id,
            'package_id' => $package->id,
            'amount' => $package->price,
            'payment_method' => 'qris',
        ]);

        // Presensi perdana tercatat jika dipilih
        $this->assertDatabaseHas('attendances', [
            'member_id' => $member->id,
            'type' => 'member',
        ]);

        // Akun User portal otomatis terhubung
        $this->assertNotNull($member->user);
        $this->assertEquals($phone, $member->user->phone);

        // 9. Member sekarang masuk kategori aktif dan TIDAK muncul lagi di daftar Pending Dashboard
        $dashboardResponse = $this->actingAs($admin)->get(route('admin.dashboard'));
        $dashboardResponse->assertStatus(200);

        // Pastikan tidak ada lagi di tabel pending dashboard
        $pendingListOnDashboard = $dashboardResponse->viewData('pendingMembers');
        $this->assertFalse($pendingListOnDashboard->contains('id', $member->id));

        // Cleanup
        Attendance::where('member_id', $member->id)->delete();
        Transaction::where('member_id', $member->id)->delete();
        if ($member->user) {
            $member->user->delete();
        }
        $member->delete();
    }

    /**
     * Skenario 10:
     * - Pencegahan duplikasi data saat member mendaftar ulang dengan no WA sama.
     */
    public function test_duplicate_registration_prevention_on_landing_page(): void
    {
        $uniquePhone = '0822'.rand(10000000, 99999999);
        $initialName = 'Pendaftar Pertama '.uniqid();

        // Pendaftaran 1
        $this->post(route('guest.register'), [
            'name' => $initialName,
            'phone' => $uniquePhone,
            'package' => '1 Month - Rp 130.000',
            'gender' => 'Laki-laki',
        ]);

        $this->assertEquals(1, Member::where('phone', $uniquePhone)->count());

        // Pendaftaran 2 dengan nomor telepon yang sama
        $duplicateResponse = $this->post(route('guest.register'), [
            'name' => 'Nama Lain Mencoba Daftar',
            'phone' => $uniquePhone,
            'package' => '3 Month - Rp 375.000',
            'gender' => 'Perempuan',
        ]);

        $duplicateResponse->assertSessionHas('info');

        // Pastikan tetap hanya ada 1 data (tidak terjadi duplikasi)
        $this->assertEquals(1, Member::where('phone', $uniquePhone)->count());

        // Cleanup
        Member::where('phone', $uniquePhone)->delete();
    }

    /**
     * Uji pemisahan statistik dan tombol "Lihat Semua (Filter Pending)".
     */
    public function test_dashboard_statistics_and_view_all_filter(): void
    {
        $admin = User::where('role', 'admin')->first();

        // 1. Test akses index dengan filter pending
        $indexResponse = $this->actingAs($admin)->get(route('admin.members.index', ['status' => 'pending_verification']));
        $indexResponse->assertStatus(200);

        // Memastikan dropdown filter status pending terpilih
        $indexResponse->assertSee('value="pending_verification" selected', false);

        // 2. Test akses index dengan parameter alias status=pending
        $aliasResponse = $this->actingAs($admin)->get(route('admin.members.index', ['status' => 'pending']));
        $aliasResponse->assertStatus(200);
        $aliasResponse->assertSee('value="pending_verification" selected', false);
    }
}
