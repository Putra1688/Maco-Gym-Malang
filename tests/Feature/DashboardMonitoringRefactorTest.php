<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\Package;
use App\Models\User;
use Tests\TestCase;

class DashboardMonitoringRefactorTest extends TestCase
{
    /**
     * Test layout, 4 summary cards, charts, and 3-record limits on dashboard monitoring.
     */
    public function test_dashboard_monitoring_refactor_elements_and_limits(): void
    {
        $admin = User::where('role', 'admin')->first();
        $this->assertNotNull($admin);

        // Create 5 pending members to test the 3-record limit
        $package = Package::where('type', 'membership')->first();
        $createdPendingMembers = [];
        for ($i = 1; $i <= 5; $i++) {
            $createdPendingMembers[] = Member::create([
                'card_id' => 'REG-TEST-'.rand(10000, 99999),
                'name' => 'Pending Tester '.$i.' '.uniqid(),
                'phone' => '0812'.rand(10000000, 99999999),
                'gender' => $i % 2 === 0 ? 'female' : 'male',
                'join_date' => today()->toDateString(),
                'current_expiry_date' => today()->toDateString(),
                'status' => 'pending_verification',
                'package_name' => $package ? $package->name : '1 Month',
            ]);
        }

        // Create 5 expiring members (H-1, H-2, H-3) to test the 3-record limit
        $createdExpiringMembers = [];
        for ($i = 1; $i <= 5; $i++) {
            $createdExpiringMembers[] = Member::create([
                'card_id' => 'MC-EXP-'.rand(10000, 99999),
                'name' => 'Expiring Tester '.$i.' '.uniqid(),
                'phone' => '0813'.rand(10000000, 99999999),
                'gender' => 'male',
                'join_date' => today()->subMonth()->toDateString(),
                'current_expiry_date' => today()->addDays($i <= 3 ? $i : 3)->toDateString(),
                'status' => 'active',
                'package_name' => $package ? $package->name : '1 Month',
            ]);
        }

        // Access dashboard
        $response = $this->actingAs($admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);

        // 1. Header & Title
        $response->assertSee('Dashboard Monitoring');
        $response->assertSee(now()->translatedFormat('l, d F Y'));

        // 2. Notification Banner
        $response->assertSee('Pemberitahuan Pendaftaran Member Baru:');
        $response->assertSee('berstatus Pending yang membutuhkan tindakan');
        $response->assertSee(route('admin.members.index', ['status' => 'pending_verification']));

        // 3. 4 Summary Cards
        $response->assertSee('Total Member Aktif');
        $response->assertSee('Member Pending');
        $response->assertSee('Kunjungan Hari Ini');
        $response->assertSee('Pemasukan Hari Ini');
        $response->assertSee('PERLU TINDAKAN');
        $response->assertSee('STATUS VALID');

        // 4. Chart Section
        $response->assertSee('Grafik Pemasukan Per Bulan');
        $response->assertSee('monthlyRevenueChart');
        $response->assertSee('Gender Member');
        $response->assertSee('genderDonutChart');
        $response->assertSee('Demografi Umur Member');
        $response->assertSee('ageDemographicChart');
        $response->assertSee('Grafik Rata-Rata Kehadiran Member');
        $response->assertSee('attendanceAvgChart');

        // 5. Section Pendaftaran Member Baru (Max 3 records)
        $response->assertSee('PENDAFTARAN MEMBER BARU');
        $pendingInView = $response->viewData('pendingMembers');
        $this->assertLessThanOrEqual(3, $pendingInView->count());

        // 6. Section Member Mendekati Jatuh Tempo (Max 3 records)
        $response->assertSee('MEMBER MENDEKATI JATUH TEMPO (H-3 s/d H-1)');
        $expiringInView = $response->viewData('expiringMembers');
        $this->assertLessThanOrEqual(3, $expiringInView->count());

        // 7. Kas Masuk dan Presensi (Max 3 records each)
        $response->assertSee('Kas Masuk Terbaru');
        $recentTransactionsInView = $response->viewData('recentTransactions');
        $this->assertLessThanOrEqual(3, $recentTransactionsInView->count());

        $response->assertSee('Presensi Kedatangan Terakhir');
        $recentAttendancesInView = $response->viewData('recentAttendances');
        $this->assertLessThanOrEqual(3, $recentAttendancesInView->count());

        // Cleanup
        foreach ($createdPendingMembers as $m) {
            $m->delete();
        }
        foreach ($createdExpiringMembers as $m) {
            $m->delete();
        }
    }

    /**
     * Test notification banner is hidden when there are 0 pending members.
     */
    public function test_notification_banner_hidden_when_zero_pending_members(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Temporarily set all pending members to active
        Member::where('status', 'pending_verification')->update(['status' => 'active']);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);

        // Banner should not be rendered
        $response->assertDontSee('Pemberitahuan Pendaftaran Member Baru:');
    }
}
