<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SystemRefactorValidationTest extends TestCase
{
    /**
     * 1. Validasi Paket Membership Resmi pada form registrasi dan katalog pricing.
     */
    public function test_registration_page_contains_only_the_six_official_membership_packages(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);

        // Paket resmi yang wajib ada
        $officialPackages = [
            'Membership 1 Month',
            'Membership 3 Month',
            'Membership 6 Month',
            'Membership 12 Month',
            'Mahasiswa',
            'Pelajar',
        ];

        foreach ($officialPackages as $package) {
            $response->assertSee($package);
        }

        // Paket yang dilarang muncul di dropdown registrasi
        $forbiddenOptions = [
            'Personal Trainer',
            'PT Single',
            'PT Couples',
            'Joining Fee',
            'Insidentil',
            'Daily Pass',
        ];

        $content = $response->getContent();
        // Cek bahwa dalam tag <select id="reg_package"> tidak ada opsi terlarang
        if (preg_match('/<select[^>]*id="reg_package"[^>]*>(.*?)<\/select>/s', $content, $matches)) {
            $selectContent = $matches[1];
            foreach ($forbiddenOptions as $forbidden) {
                $this->assertStringNotContainsString(
                    $forbidden,
                    $selectContent,
                    "Select dropdown paket registrasi tidak boleh memuat {$forbidden}"
                );
            }
        } else {
            $this->fail('Element <select id="reg_package"> tidak ditemukan pada halaman registrasi.');
        }
    }

    /**
     * 2. Registrasi berhasil untuk paket membership resmi.
     */
    public function test_registration_succeeds_with_official_membership_package(): void
    {
        $uniquePhone = '0812'.rand(10000000, 99999999);
        $payload = [
            'name' => 'Member Uji Coba',
            'phone' => $uniquePhone,
            'package' => 'Membership 1 Month',
            'gender' => 'male',
            'address' => 'Jl. Ijen No. 12 Malang',
        ];

        $response = $this->post(route('guest.register'), $payload);

        $response->assertRedirect(route('register'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('members', [
            'phone' => $uniquePhone,
            'name' => 'Member Uji Coba',
            'package_name' => 'Membership 1 Month',
        ]);
    }

    /**
     * 3. Registrasi menolak jika paket bukan kategori membership resmi atau tidak aktif (misal paket PT).
     */
    public function test_registration_rejects_inactive_or_pt_packages(): void
    {
        $uniquePhone = '0813'.rand(10000000, 99999999);
        $payload = [
            'name' => 'Member Ditolak',
            'phone' => $uniquePhone,
            'package' => 'PT Single 12 Sesi',
            'gender' => 'male',
        ];

        $response = $this->post(route('guest.register'), $payload);

        $response->assertSessionHasErrors('package');
        $this->assertDatabaseMissing('members', [
            'phone' => $uniquePhone,
        ]);
    }

    /**
     * 4. Halaman Pricing Personal Trainer (Single & Couples) murni katalog informasi dan mengarahkan ke WhatsApp.
     */
    public function test_pt_pricing_pages_do_not_link_to_membership_registration(): void
    {
        // PT Single
        $responseSingle = $this->get(route('pricing.pt-single'));
        $responseSingle->assertStatus(200);
        $responseSingle->assertSee('PERSONAL TRAINER');
        $responseSingle->assertSee('SINGLE');
        $responseSingle->assertSee('https://wa.me/6281250207403', false);
        $this->assertStringNotContainsString(
            route('register').'?package=',
            $responseSingle->getContent(),
            'Halaman PT Single tidak boleh mengarahkan ke alur registrasi membership paket PT.'
        );

        // PT Couples
        $responseCouples = $this->get(route('pricing.pt-couples'));
        $responseCouples->assertStatus(200);
        $responseCouples->assertSee('PERSONAL TRAINER');
        $responseCouples->assertSee('COUPLES');
        $responseCouples->assertSee('https://wa.me/6281250207403', false);
        $this->assertStringNotContainsString(
            route('register').'?package=',
            $responseCouples->getContent(),
            'Halaman PT Couples tidak boleh mengarahkan ke alur registrasi membership paket PT.'
        );
    }

    /**
     * 5. Halaman Pricing Membership menampilkan Joining Fee dan Insidentil sebagai informasi biaya, bukan link registrasi.
     */
    public function test_membership_pricing_shows_joining_fee_and_insidentil_as_info_only(): void
    {
        $response = $this->get(route('pricing.membership'));
        $response->assertStatus(200);
        $response->assertSee('Joining Fee');
        $response->assertSee('Rp 20.000');
        $response->assertSee('Insidentil');
        $response->assertSee('Rp 30.000');

        $content = $response->getContent();
        $this->assertStringNotContainsString(route('register').'?package=Joining', $content);
        $this->assertStringNotContainsString(route('register').'?package=Insidentil', $content);
    }

    /**
     * 6. Persistent Login: Checkbox Remember Me tersedia di halaman login.
     */
    public function test_login_page_has_remember_me_checkbox(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertSee('name="remember"', false);
        $response->assertSee('Ingat Saya');
    }

    /**
     * 7. Persistent Login: Login dengan 'remember' menghasilkan remember_token di database dan cookie remember.
     */
    public function test_login_with_remember_me_sets_remember_token_and_cookie(): void
    {
        $admin = User::where('role', 'admin')->first();
        $this->assertNotNull($admin, 'User admin harus ada.');

        $response = $this->post(route('login'), [
            'phone' => $admin->phone,
            'password' => 'password123',
            'remember' => '1',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);

        // Refresh user dari database untuk memverifikasi remember_token terisi
        $admin->refresh();
        $this->assertNotNull($admin->remember_token, 'remember_token pada database harus terisi saat remember me dicentang.');

        // Cookie remember_web_* harus dibuat pada response
        $cookieFound = false;
        foreach ($response->headers->getCookies() as $cookie) {
            if (str_starts_with($cookie->getName(), 'remember_web_')) {
                $cookieFound = true;
                break;
            }
        }
        $this->assertTrue($cookieFound, 'Cookie remember_web_* harus dikirimkan ke client saat remember me aktif.');
    }

    /**
     * 8. Persistent Login: Login tanpa 'remember' tidak menghasilkan cookie remember_web_*.
     */
    public function test_login_without_remember_me_does_not_set_remember_cookie(): void
    {
        $admin = User::where('role', 'admin')->first();
        $this->assertNotNull($admin, 'User admin harus ada.');

        $response = $this->post(route('login'), [
            'phone' => $admin->phone,
            'password' => 'password123',
            // remember tidak dikirim
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);

        // Cookie remember_web_* tidak boleh ada
        $cookieFound = false;
        foreach ($response->headers->getCookies() as $cookie) {
            if (str_starts_with($cookie->getName(), 'remember_web_')) {
                $cookieFound = true;
                break;
            }
        }
        $this->assertFalse($cookieFound, 'Cookie remember_web_* tidak boleh ada saat remember me tidak dicentang.');
    }

    /**
     * 9. Logout mengakhiri autentikasi dan membersihkan session.
     */
    public function test_logout_clears_authentication(): void
    {
        $admin = User::where('role', 'admin')->first();
        $this->actingAs($admin);

        $response = $this->post(route('logout'));

        $response->assertRedirect('/');
        $this->assertGuest();
    }

    /**
     * 10. Role Staff telah sepenuhnya dihapus dari definisi skema tabel users.
     */
    public function test_staff_role_completely_removed_from_database_schema(): void
    {
        // Periksa tipe kolom role pada tabel users
        $columns = DB::select("SHOW COLUMNS FROM users WHERE Field = 'role'");
        $this->assertNotEmpty($columns);

        $type = $columns[0]->Type;
        $this->assertStringNotContainsString("'staff'", $type, "Kolom ENUM role tidak boleh lagi memuat 'staff'. Tipe saat ini: {$type}");
        $this->assertStringContainsString("'admin'", $type);
        $this->assertStringContainsString("'member'", $type);

        // Pastikan tidak ada satupun user di database dengan role 'staff'
        $staffCount = DB::table('users')->where('role', 'staff')->count();
        $this->assertEquals(0, $staffCount, 'Tidak boleh ada record user dengan role staff.');
    }

    /**
     * 11. Model User tidak lagi memiliki method isStaff().
     */
    public function test_user_model_does_not_have_is_staff_method(): void
    {
        $this->assertFalse(
            method_exists(User::class, 'isStaff'),
            'Method isStaff() harus sudah dihapus dari User model.'
        );
    }

    /**
     * 12. Akses admin tetap berfungsi untuk role admin, dan menolak member.
     */
    public function test_admin_routes_accessible_by_admin_and_forbidden_for_members(): void
    {
        $admin = User::where('role', 'admin')->first();
        $member = User::where('role', 'member')->first();

        // Admin can access admin dashboard & frontdesk
        $responseAdmin = $this->actingAs($admin)->get(route('admin.dashboard'));
        $responseAdmin->assertStatus(200);

        $responseFrontdesk = $this->actingAs($admin)->get(route('admin.frontdesk.index'));
        $responseFrontdesk->assertStatus(200);

        // Member gets 403 on admin routes
        if ($member) {
            $responseMember = $this->actingAs($member)->get(route('admin.dashboard'));
            $responseMember->assertStatus(403);
        }
    }
}
