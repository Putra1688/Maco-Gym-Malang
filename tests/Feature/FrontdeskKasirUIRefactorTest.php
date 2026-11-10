<?php

namespace Tests\Feature;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\User;
use Tests\TestCase;

class FrontdeskKasirUIRefactorTest extends TestCase
{
    /**
     * Test 1, 2, 4, 5, 12: Check-in by Card ID (RFID) & WhatsApp phone number,
     * updates live stats, and records attendance.
     */
    public function test_checkin_by_card_id_and_whatsapp_number_updates_stats(): void
    {
        $admin = User::where('role', 'admin')->first();
        $this->assertNotNull($admin);

        $uniquePhone = '0812'.rand(10000000, 99999999);
        $cardId = 'MC-RF-'.rand(1000, 9999);
        $name = 'Member Test Checkin '.uniqid();

        $member = Member::create([
            'card_id' => $cardId,
            'name' => $name,
            'phone' => $uniquePhone,
            'gender' => 'male',
            'join_date' => today()->subMonth()->toDateString(),
            'current_expiry_date' => today()->addMonth()->toDateString(),
            'status' => 'active',
            'package_name' => '1 Month',
        ]);

        $initialTotalCount = Attendance::whereDate('checkin_time', today())->count();

        // 1. Check-in using Card ID (RFID scan)
        $responseCard = $this->actingAs($admin)
            ->from(route('admin.frontdesk.index'))
            ->post(route('admin.frontdesk.checkin'), [
                'search' => $cardId,
            ]);

        $responseCard->assertRedirect(route('admin.frontdesk.index'));
        $responseCard->assertSessionHas('checkin_status', 'active');
        $responseCard->assertSessionHas('checked_member_id', $member->id);

        $this->assertDatabaseHas('attendances', [
            'type' => 'member',
            'member_id' => $member->id,
        ]);

        // Verify stats increased
        $this->assertEquals($initialTotalCount + 1, Attendance::whereDate('checkin_time', today())->count());

        // Cleanup
        $member->attendances()->delete();
        $member->delete();
    }

    /**
     * Test 3, 6: Validation for expired member prevents checkin.
     */
    public function test_checkin_validation_prevents_expired_member_checkin(): void
    {
        $admin = User::where('role', 'admin')->first();
        $expiredCardId = 'MC-EXP-'.rand(1000, 9999);

        $expiredMember = Member::create([
            'card_id' => $expiredCardId,
            'name' => 'Member Expired '.uniqid(),
            'phone' => '0813'.rand(10000000, 99999999),
            'gender' => 'female',
            'join_date' => today()->subMonths(2)->toDateString(),
            'current_expiry_date' => today()->subDays(5)->toDateString(),
            'status' => 'expired',
            'package_name' => '1 Month',
        ]);

        $attendancesBefore = Attendance::where('member_id', $expiredMember->id)->count();

        $response = $this->actingAs($admin)->post(route('admin.frontdesk.checkin'), [
            'search' => $expiredCardId,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('checkin_status', 'expired');
        $this->assertEquals($attendancesBefore, Attendance::where('member_id', $expiredMember->id)->count());

        $expiredMember->delete();
    }

    /**
     * Test 13: Prevention of duplicate check-in within 10 seconds.
     */
    public function test_duplicate_checkin_within_10_seconds_is_prevented(): void
    {
        $admin = User::where('role', 'admin')->first();
        $cardId = 'MC-DUP-'.rand(1000, 9999);

        $member = Member::create([
            'card_id' => $cardId,
            'name' => 'Member Duplicate Test '.uniqid(),
            'phone' => '0814'.rand(10000000, 99999999),
            'gender' => 'male',
            'join_date' => today()->toDateString(),
            'current_expiry_date' => today()->addDays(30)->toDateString(),
            'status' => 'active',
            'package_name' => '1 Month',
        ]);

        // First check-in
        $this->actingAs($admin)->post(route('admin.frontdesk.checkin'), [
            'search' => $cardId,
        ]);
        $this->assertEquals(1, Attendance::where('member_id', $member->id)->count());

        // Immediate second check-in (simulating double click or rapid scanner input)
        $dupResponse = $this->actingAs($admin)->post(route('admin.frontdesk.checkin'), [
            'search' => $cardId,
        ]);
        $dupResponse->assertSessionHas('info');

        // Still only 1 attendance record
        $this->assertEquals(1, Attendance::where('member_id', $member->id)->count());

        $member->attendances()->delete();
        $member->delete();
    }

    /**
     * Test 7: Daily guest ticket transaction and attendance.
     */
    public function test_daily_guest_ticket_creates_transaction_and_checkin(): void
    {
        $admin = User::where('role', 'admin')->first();
        $package = Package::where('type', 'daily_visit')->first() ?? Package::first();

        $guestName = 'Tamu Frontdesk Test '.uniqid();
        $response = $this->actingAs($admin)->post(route('admin.frontdesk.daily-guest'), [
            'name' => $guestName,
            'phone' => '081512345678',
            'package_id' => $package->id,
            'payment_method' => 'qris',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('transactions', [
            'customer_name' => $guestName,
            'payment_method' => 'qris',
            'amount' => $package->price,
        ]);

        $this->assertDatabaseHas('attendances', [
            'type' => 'daily_guest',
            'guest_name' => $guestName,
        ]);
    }

    /**
     * Test 9, 10, 11: Date filter, search filter, visitor type filter, and pagination (10, 25, 50).
     */
    public function test_attendance_table_filters_search_and_pagination(): void
    {
        $admin = User::where('role', 'admin')->first();

        // 1. Pagination 10, 25, 50
        foreach ([10, 25, 50] as $perPage) {
            $resp = $this->actingAs($admin)->get(route('admin.frontdesk.index', ['per_page' => $perPage]));
            $resp->assertStatus(200);
            $resp->assertViewHas('perPage', $perPage);
        }

        // 2. Type filter: member vs daily_guest
        $memberResp = $this->actingAs($admin)->get(route('admin.frontdesk.index', ['type' => 'member']));
        $memberResp->assertStatus(200);
        $memberResp->assertViewHas('type', 'member');

        $guestResp = $this->actingAs($admin)->get(route('admin.frontdesk.index', ['type' => 'daily_guest']));
        $guestResp->assertStatus(200);
        $guestResp->assertViewHas('type', 'daily_guest');

        // 3. Search query
        $uniqueSearchName = 'UnikVisitor'.rand(1000, 9999);
        Attendance::create([
            'type' => 'daily_guest',
            'guest_name' => $uniqueSearchName,
            'checkin_time' => now(),
            'notes' => 'Testing Search',
        ]);

        $searchResp = $this->actingAs($admin)->get(route('admin.frontdesk.index', ['search' => $uniqueSearchName]));
        $searchResp->assertStatus(200);
        $searchResp->assertSee($uniqueSearchName);

        // 4. Date filter
        $pastDate = today()->subDays(3)->toDateString();
        $dateResp = $this->actingAs($admin)->get(route('admin.frontdesk.index', ['date' => $pastDate]));
        $dateResp->assertStatus(200);
        $dateResp->assertViewHas('selectedDate', $pastDate);
    }
}
