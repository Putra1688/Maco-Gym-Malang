<?php

namespace Tests\Feature;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\Package;
use App\Models\User;
use Tests\TestCase;

class ManagementSystemTest extends TestCase
{
    public function test_login_page_renders_successfully(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('MACO');
        $response->assertSee('GYM');
    }

    public function test_admin_can_login_with_phone_and_access_dashboard(): void
    {
        $admin = User::where('role', 'admin')->first();

        $response = $this->post('/login', [
            'phone' => $admin->phone,
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));

        $dashboardResponse = $this->actingAs($admin)->get(route('admin.dashboard'));
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('Total Member Aktif');
        $dashboardResponse->assertSee('Dashboard Monitoring');

        // Verify the 4 New Analytics Charts
        $dashboardResponse->assertSee('Grafik Pemasukan Per Bulan');
        $dashboardResponse->assertSee('monthlyRevenueChart');
        $dashboardResponse->assertSee('Gender Member');
        $dashboardResponse->assertSee('genderDonutChart');
        $dashboardResponse->assertSee('Demografi Umur Member');
        $dashboardResponse->assertSee('ageDemographicChart');
        $dashboardResponse->assertSee('Rata-Rata Kehadiran Member');
        $dashboardResponse->assertSee('attendanceAvgChart');
    }

    public function test_member_can_login_with_card_id_and_access_member_portal(): void
    {
        $member = Member::where('card_id', 'MC-001')->first();
        $user = $member->user;

        $response = $this->post('/login', [
            'phone' => 'MC-001', // Login menggunakan Card ID
            'password' => 'member123',
        ]);

        $response->assertRedirect(route('member.dashboard'));

        $memberResponse = $this->actingAs($user)->get(route('member.dashboard'));
        $memberResponse->assertStatus(200);
        $memberResponse->assertSee('MC-001');
        $memberResponse->assertSee('Kartu Anggota Resmi');
    }

    public function test_frontdesk_quick_checkin_and_daily_guest(): void
    {
        $admin = User::where('role', 'admin')->first();
        $package = Package::where('type', 'daily_visit')->first();

        // Checkin Member MC-001 (Aktif)
        $checkinResponse = $this->actingAs($admin)->post(route('admin.frontdesk.checkin'), [
            'search' => 'MC-001',
        ]);
        $checkinResponse->assertRedirect();
        $checkinResponse->assertSessionHas('checkin_status', 'active');

        // Checkin Member MC-002 (Hampir Habis H-2)
        $h2Response = $this->actingAs($admin)->post(route('admin.frontdesk.checkin'), [
            'search' => 'MC-002',
        ]);
        $h2Response->assertRedirect();
        $h2Response->assertSessionHas('checkin_status', 'expiring_soon');

        // Checkin Member MC-003 (Kadaluarsa)
        $expiredCountBefore = Attendance::where('member_id', Member::where('card_id', 'MC-003')->first()->id)->count();
        $expiredResponse = $this->actingAs($admin)->post(route('admin.frontdesk.checkin'), [
            'search' => 'MC-003',
        ]);
        $expiredResponse->assertRedirect();
        $expiredResponse->assertSessionHas('checkin_status', 'expired');
        $expiredCountAfter = Attendance::where('member_id', Member::where('card_id', 'MC-003')->first()->id)->count();
        $this->assertEquals($expiredCountBefore, $expiredCountAfter, 'Expired member should not automatically check in');

        // Input Tamu Harian
        $guestResponse = $this->actingAs($admin)->post(route('admin.frontdesk.daily-guest'), [
            'name' => 'Tamu Uji Coba',
            'phone' => '0899999999',
            'package_id' => $package->id,
            'payment_method' => 'cash',
        ]);
        $guestResponse->assertRedirect();
        $guestResponse->assertSessionHas('success');
    }

    public function test_renewal_accumulates_remaining_days(): void
    {
        $admin = User::where('role', 'admin')->first();
        $member = Member::where('card_id', 'MC-001')->first();
        $package = Package::where('type', 'membership')->first();

        $originalExpiry = $member->current_expiry_date->copy();

        $this->actingAs($admin)->post(route('admin.members.renew', $member), [
            'package_id' => $package->id,
            'payment_method' => 'cash',
        ]);

        $member->refresh();
        $expectedExpiry = $originalExpiry->addDays($package->duration_days)->toDateString();
        $this->assertEquals($expectedExpiry, $member->current_expiry_date->toDateString());
    }

    public function test_member_can_log_physical_progress(): void
    {
        $member = Member::where('card_id', 'MC-001')->first();
        $user = $member->user;

        $response = $this->actingAs($user)->post(route('member.progress.store'), [
            'weight_kg' => 75.2,
            'height_cm' => 176,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('member_progress', [
            'member_id' => $member->id,
            'weight_kg' => 75.20,
            'height_cm' => 176.00,
        ]);
    }

    public function test_admin_can_access_all_management_modules(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->actingAs($admin)->get(route('admin.frontdesk.index'))->assertStatus(200);
        $this->actingAs($admin)->get(route('admin.members.index'))->assertStatus(200);
        $this->actingAs($admin)->get(route('admin.packages.index'))->assertStatus(200);
        $this->actingAs($admin)->get(route('admin.transactions.index'))->assertStatus(200);
        $this->actingAs($admin)->get(route('admin.trainers.index'))->assertStatus(200);
    }
}
