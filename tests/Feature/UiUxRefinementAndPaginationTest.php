<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\User;
use Tests\TestCase;

class UiUxRefinementAndPaginationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Member::where('card_id', 'like', 'MC-JUMP%')
            ->orWhere('card_id', 'like', 'MC-PERPAGE%')
            ->orWhere('card_id', 'like', 'MC-TRUEJUMP%')
            ->orWhere('card_id', 'like', 'REG-%')
            ->orWhere('card_id', 'like', 'MC-TEST-EXP%')
            ->delete();
    }

    protected function tearDown(): void
    {
        Member::where('card_id', 'like', 'MC-JUMP%')
            ->orWhere('card_id', 'like', 'MC-PERPAGE%')
            ->orWhere('card_id', 'like', 'MC-TRUEJUMP%')
            ->orWhere('card_id', 'like', 'REG-%')
            ->orWhere('card_id', 'like', 'MC-TEST-EXP%')
            ->delete();
        parent::tearDown();
    }

    /**
     * Test Jump Pagination renders dynamic links, active indicator, ellipses, and preserves query parameters.
     */
    public function test_jump_pagination_renders_dynamic_links_and_preserves_query_params(): void
    {
        $admin = User::where('role', 'admin')->first();
        $this->assertNotNull($admin);

        // Create 35 temporary members so with per_page=5 we have 7 pages
        $createdMembers = [];
        for ($i = 1; $i <= 35; $i++) {
            $createdMembers[] = Member::create([
                'card_id' => 'MC-JUMP-'.uniqid().'-'.$i,
                'name' => 'Jump Test Member '.$i,
                'phone' => '0899'.rand(10000000, 99999999),
                'gender' => 'male',
                'join_date' => today()->toDateString(),
                'current_expiry_date' => today()->addDays(30)->toDateString(),
                'status' => 'active',
                'package_name' => '1 Month',
            ]);
        }

        // Test request to members index with per_page=5, search='Jump Test Member', page=4
        $response = $this->actingAs($admin)->get(route('admin.members.index', [
            'search' => 'Jump Test Member',
            'per_page' => 10,
            'page' => 2,
        ]));

        $response->assertStatus(200);

        // Assert Jump Pagination view is rendered
        $response->assertSee('aria-label="Pagination Navigation"', false);
        $response->assertSee('aria-current="page"', false);
        $response->assertSee('&lsaquo;', false);
        $response->assertSee('&rsaquo;', false);

        // Assert query parameters are preserved in the pagination link URLs
        $response->assertSee('search=', false);
        $response->assertSee('per_page=10', false);

        // Cleanup created members
        foreach ($createdMembers as $m) {
            $m->delete();
        }
    }

    /**
     * Test dropdown per_page is moved to bottom of tables and not in the top filter bar.
     */
    public function test_per_page_dropdown_is_in_table_footer_and_absent_from_top_filter(): void
    {
        $admin = User::where('role', 'admin')->first();

        // 1. Frontdesk
        $frontdeskResp = $this->actingAs($admin)->get(route('admin.frontdesk.index'));
        $frontdeskResp->assertStatus(200);

        // Ensure bottom footer has 'Baris per halaman:'
        $frontdeskResp->assertSee('frontdesk-per-page-bottom');
        $frontdeskResp->assertSee('Baris per halaman:');
        $frontdeskResp->assertSee('Menampilkan');
        $frontdeskResp->assertSee('data');

        // 2. Members Index
        $membersResp = $this->actingAs($admin)->get(route('admin.members.index'));
        $membersResp->assertStatus(200);
        $membersResp->assertSee('member-per-page-bottom');
        $membersResp->assertSee('Baris per halaman:');
        $membersResp->assertSee('Menampilkan');
    }

    /**
     * Test Section 3 (Biaya Tambahan / Insidentil) has balanced column widths and mobile responsive cards.
     */
    public function test_biaya_tambahan_section_structure_and_mobile_layout(): void
    {
        $response = $this->get(route('pricing.membership'));
        $response->assertStatus(200);

        // Header
        $response->assertSee('3. Biaya Tambahan / Insidentil');

        // Desktop Table with balanced column widths
        $response->assertSee('w-[26%] min-w-[210px]', false);
        $response->assertSee('w-[18%] min-w-[180px]', false);
        $response->assertSee('Biaya Registrasi Awal');
        $response->assertSee('Bayar Langsung di Kasir');

        // Mobile cards alternative
        $response->assertSee('block md:hidden', false);
        $response->assertSee('Regular Membership (Joining Fee)');
        $response->assertSee('Rp 20.000');
        $response->assertSee('Insidentil');
        $response->assertSee('Rp 30.000');
    }

    /**
     * Test PT Single and Couples design system consistency.
     */
    public function test_pt_single_and_couples_design_consistency(): void
    {
        $singleResp = $this->get(route('pricing.pt-single'));
        $singleResp->assertStatus(200);
        $singleResp->assertSee('Ketentuan Resmi Jasa Personal Trainer Single (1-on-1)');
        $singleResp->assertSee('1 Klien : 1 Trainer');
        $singleResp->assertSee('w-[22%] min-w-[170px]', false);
        $singleResp->assertSee('min-w-[150px]', false);
        $singleResp->assertSee('Populer');
        $singleResp->assertSee('Best Value');

        $couplesResp = $this->get(route('pricing.pt-couples'));
        $couplesResp->assertStatus(200);
        $couplesResp->assertSee('Ketentuan Resmi Jasa Personal Trainer Couples (Duo)');
        $couplesResp->assertSee('2 Klien : 1 Trainer');
        $couplesResp->assertSee('w-[22%] min-w-[170px]', false);
        $couplesResp->assertSee('min-w-[150px]', false);
        $couplesResp->assertSee('Populer');
        $couplesResp->assertSee('Best Value');
    }

    /**
     * Test Modal Verifikasi & Aktivasi Member Baru consistency and structure.
     */
    public function test_modal_verifikasi_dan_aktivasi_structure_and_consistency(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Create a pending member
        $pendingMember = Member::create([
            'card_id' => 'REG-'.rand(1000, 9999),
            'name' => 'Calon Member Modal Test',
            'phone' => '0877'.rand(10000000, 99999999),
            'gender' => 'female',
            'join_date' => today()->toDateString(),
            'current_expiry_date' => today()->toDateString(),
            'status' => 'pending_verification',
            'package_name' => 'Membership 1 Month',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.members.show', ['member' => $pendingMember->id, 'verify' => 1]));
        $response->assertStatus(200);

        // Assert Modal Header, Body scrolling, and Sticky Footer
        $response->assertSee('showVerifyModal');
        $response->assertSee('Verifikasi & Aktivasi Member Baru', false);
        $response->assertSee('max-h-[90vh]', false);
        $response->assertSee('overflow-y-auto flex-1 space-y-4', false);
        $response->assertSee('Setujui & Aktifkan Member', false);
        $response->assertSee('Batal');
        $response->assertSee('Langsung catat presensi latihan hari ini');

        $pendingMember->delete();
    }

    /**
     * Test functional rows per page (10, 25, 50, 100) modifies database records returned.
     */
    public function test_per_page_functional_query_returns_expected_record_counts_10_25_50_100(): void
    {
        $admin = User::where('role', 'admin')->first();
        $this->assertNotNull($admin);

        // Create 60 temporary members with distinct search tag
        $testMembers = [];
        for ($i = 1; $i <= 60; $i++) {
            $testMembers[] = Member::create([
                'card_id' => 'MC-PERPAGE-'.str_pad((string) $i, 3, '0', STR_PAD_LEFT),
                'name' => 'RowsPerPage Test Member '.$i,
                'phone' => '0812'.rand(10000000, 99999999),
                'gender' => 'male',
                'join_date' => today()->toDateString(),
                'current_expiry_date' => today()->addDays(30)->toDateString(),
                'status' => 'active',
                'package_name' => '1 Month',
            ]);
        }

        try {
            // 1. per_page = 10
            $resp10 = $this->actingAs($admin)->get(route('admin.members.index', ['search' => 'RowsPerPage Test Member', 'per_page' => 10]));
            $resp10->assertStatus(200);
            $members10 = $resp10->viewData('members');
            $this->assertEquals(10, $members10->count());
            $this->assertEquals(60, $members10->total());
            $this->assertEquals(6, $members10->lastPage());
            $resp10->assertSee('<option value="10" selected>10</option>', false);

            // 2. per_page = 25
            $resp25 = $this->actingAs($admin)->get(route('admin.members.index', ['search' => 'RowsPerPage Test Member', 'per_page' => 25]));
            $resp25->assertStatus(200);
            $members25 = $resp25->viewData('members');
            $this->assertEquals(25, $members25->count());
            $this->assertEquals(60, $members25->total());
            $this->assertEquals(3, $members25->lastPage());
            $resp25->assertSee('<option value="25" selected>25</option>', false);

            // 3. per_page = 50
            $resp50 = $this->actingAs($admin)->get(route('admin.members.index', ['search' => 'RowsPerPage Test Member', 'per_page' => 50]));
            $resp50->assertStatus(200);
            $members50 = $resp50->viewData('members');
            $this->assertEquals(50, $members50->count());
            $this->assertEquals(60, $members50->total());
            $this->assertEquals(2, $members50->lastPage());
            $resp50->assertSee('<option value="50" selected>50</option>', false);

            // 4. per_page = 100
            $resp100 = $this->actingAs($admin)->get(route('admin.members.index', ['search' => 'RowsPerPage Test Member', 'per_page' => 100]));
            $resp100->assertStatus(200);
            $members100 = $resp100->viewData('members');
            $this->assertEquals(60, $members100->count());
            $this->assertEquals(60, $members100->total());
            $this->assertEquals(1, $members100->lastPage());
            $resp100->assertSee('<option value="100" selected>100</option>', false);
        } finally {
            foreach ($testMembers as $m) {
                $m->delete();
            }
        }
    }

    /**
     * Test True Jump Pagination window rendering on first, middle, and last pages.
     */
    public function test_true_jump_pagination_window_and_direct_jump_control(): void
    {
        $admin = User::where('role', 'admin')->first();
        $this->assertNotNull($admin);

        // Create 120 members to test a 12-page scenario with per_page=10
        $jumpMembers = [];
        for ($i = 1; $i <= 120; $i++) {
            $jumpMembers[] = Member::create([
                'card_id' => 'MC-TRUEJUMP-'.str_pad((string) $i, 3, '0', STR_PAD_LEFT),
                'name' => 'TrueJump Member '.$i,
                'phone' => '0813'.rand(10000000, 99999999),
                'gender' => 'male',
                'join_date' => today()->toDateString(),
                'current_expiry_date' => today()->addDays(30)->toDateString(),
                'status' => 'active',
                'package_name' => '1 Month',
            ]);
        }

        try {
            // Case 1: First page (page 1) -> expects 1 2 3 4 5 ... 12 (max 5 numbers in cluster)
            $respP1 = $this->actingAs($admin)->get(route('admin.members.index', ['search' => 'TrueJump Member', 'per_page' => 10, 'page' => 1]));
            $respP1->assertStatus(200);
            $respP1->assertSee('Halaman 2');
            $respP1->assertSee('Halaman 3');
            $respP1->assertSee('Halaman 4');
            $respP1->assertSee('Halaman 5');
            $respP1->assertSee('Halaman 12');
            $respP1->assertSee("\xe2\x80\xa6"); // Unicode ellipsis …
            $respP1->assertSee('Ke halaman');
            $respP1->assertDontSee('GO</button>', false); // No GO button
            $respP1->assertDontSee('Halaman 6');
            $respP1->assertDontSee('Halaman 7');

            // Case 2: Middle page (page 6) -> expects 1 ... 4 5 6 7 8 ... 12 (max 5 numbers in cluster)
            $respP6 = $this->actingAs($admin)->get(route('admin.members.index', ['search' => 'TrueJump Member', 'per_page' => 10, 'page' => 6]));
            $respP6->assertStatus(200);
            $respP6->assertSee('Halaman 1');
            $respP6->assertSee('Halaman 4');
            $respP6->assertSee('Halaman 5');
            $respP6->assertSee('Halaman 7');
            $respP6->assertSee('Halaman 8');
            $respP6->assertSee('Halaman 12');
            $respP6->assertDontSee('Halaman 2');
            $respP6->assertDontSee('Halaman 3');
            $respP6->assertDontSee('Halaman 9');
            $respP6->assertDontSee('Halaman 10');

            // Case 3: Last page (page 12) -> expects 1 ... 8 9 10 11 12 (max 5 numbers in cluster)
            $respP12 = $this->actingAs($admin)->get(route('admin.members.index', ['search' => 'TrueJump Member', 'per_page' => 10, 'page' => 12]));
            $respP12->assertStatus(200);
            $respP12->assertSee('Halaman 1');
            $respP12->assertSee('Halaman 8');
            $respP12->assertSee('Halaman 9');
            $respP12->assertSee('Halaman 10');
            $respP12->assertSee('Halaman 11');
            $respP12->assertDontSee('Halaman 2');
            $respP12->assertDontSee('Halaman 3');
            $respP12->assertDontSee('Halaman 7');
        } finally {
            foreach ($jumpMembers as $m) {
                $m->delete();
            }
        }
    }

    /**
     * Test Frontdesk Kasir rows per page dropdown options (10, 25, 50, 100).
     */
    public function test_frontdesk_rows_per_page_options_and_persistence(): void
    {
        $admin = User::where('role', 'admin')->first();
        $this->assertNotNull($admin);

        foreach ([10, 25, 50, 100] as $limit) {
            $response = $this->actingAs($admin)->get(route('admin.frontdesk.index', ['per_page' => $limit]));
            $response->assertStatus(200);
            $response->assertSee('<option value="'.$limit.'" selected>'.$limit.'</option>', false);
        }
    }
}
