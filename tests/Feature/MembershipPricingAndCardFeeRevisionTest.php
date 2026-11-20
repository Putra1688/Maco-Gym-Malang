<?php

namespace Tests\Feature;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\User;
use Tests\TestCase;

class MembershipPricingAndCardFeeRevisionTest extends TestCase
{
    /**
     * 1. Pastikan harga membership reguler 1 bulan adalah Rp130.000, bukan Rp135.000.
     * Pastikan tidak ada harga Rp135.000 pada paket membership 1 bulan di seluruh halaman.
     */
    public function test_one_month_membership_price_is_130k_and_no_135k_used(): void
    {
        // A. Cek Landing Page
        $homeRes = $this->get('/');
        $homeRes->assertStatus(200);
        $homeRes->assertDontSee('Rp 135.000');
        $homeRes->assertDontSee('Rp135.000');
        $homeRes->assertDontSee('135k');

        // B. Cek Halaman Detail Pricing Membership
        $pricingRes = $this->get(route('pricing.membership'));
        $pricingRes->assertStatus(200);
        $pricingRes->assertSee('Membership 1 Month');
        $pricingRes->assertSee('Rp 130.000');
        $pricingRes->assertDontSee('Rp 135.000');
        $pricingRes->assertDontSee('Rp135.000');

        // C. Cek Formulir Registrasi Online
        $registerRes = $this->get(route('register'));
        $registerRes->assertStatus(200);
        $registerRes->assertSee('Membership 1 Month (Rp 130.000 / 30 Hari)');
        $registerRes->assertDontSee('135.000');

        // D. Cek Database Package
        $pkg1Month = Package::where('name', 'Membership 1 Month')->first();
        $this->assertNotNull($pkg1Month);
        $this->assertEquals(130000, (float) $pkg1Month->price);
    }

    /**
     * 2. Integrasikan biaya kartu member fisik Rp20.000 ke invoice saat pendaftaran baru walk-in.
     * Contoh: Membership 1 bulan Rp130.000 + Kartu Rp20.000 = Total Rp150.000.
     */
    public function test_walkin_new_membership_registration_automatically_adds_card_fee_to_invoice(): void
    {
        $admin = User::where('role', 'admin')->first();
        $pkg1Month = Package::where('name', 'Membership 1 Month')->first();
        $uniquePhone = '0812'.rand(10000000, 99999999);
        $cardId = 'MC-TEST-'.rand(1000, 9999);

        $response = $this->actingAs($admin)->post(route('admin.members.store'), [
            'card_id' => $cardId,
            'name' => 'Member Walkin 1 Bulan',
            'phone' => $uniquePhone,
            'gender' => 'male',
            'status' => 'active',
            'package_id' => $pkg1Month->id,
            'payment_method' => 'cash',
            'checkin_now' => 1,
        ]);

        $response->assertRedirect(route('admin.members.index'));

        $member = Member::where('card_id', $cardId)->first();
        $this->assertNotNull($member);

        // Transaksi harus bernilai Rp150.000 (130.000 + 20.000)
        $tx = Transaction::where('member_id', $member->id)->first();
        $this->assertNotNull($tx);
        $this->assertEquals(150000, (float) $tx->amount);
        $this->assertEquals(130000, (float) $tx->package_price);
        $this->assertEquals(20000, (float) $tx->card_fee);
        $this->assertEquals('cash', $tx->payment_method);

        // Cleanup
        Attendance::where('member_id', $member->id)->delete();
        $tx->delete();
        if ($member->user) {
            $member->user->delete();
        }
        $member->delete();
    }

    /**
     * Contoh lainnya sesuai spesifikasi:
     * - Membership 3 bulan: Rp375.000 + Rp20.000 = Rp395.000.
     * - Membership 6 bulan: Rp750.000 + Rp20.000 = Rp770.000.
     * - Membership 12 bulan: Rp1.450.000 + Rp20.000 = Rp1.470.000.
     */
    public function test_walkin_new_membership_registration_other_packages_add_card_fee_correctly(): void
    {
        $admin = User::where('role', 'admin')->first();
        $pkg3Month = Package::where('name', 'Membership 3 Month')->first();
        $uniquePhone = '0813'.rand(10000000, 99999999);
        $cardId = 'MC-3M-'.rand(1000, 9999);

        $this->actingAs($admin)->post(route('admin.members.store'), [
            'card_id' => $cardId,
            'name' => 'Member Walkin 3 Bulan',
            'phone' => $uniquePhone,
            'gender' => 'female',
            'status' => 'active',
            'package_id' => $pkg3Month->id,
            'payment_method' => 'qris',
            'checkin_now' => 0,
        ]);

        $member = Member::where('card_id', $cardId)->first();
        $this->assertNotNull($member);

        $tx = Transaction::where('member_id', $member->id)->first();
        $this->assertNotNull($tx);
        $this->assertEquals(395000, (float) $tx->amount, 'Total harus 375.000 + 20.000 = 395.000');
        $this->assertEquals(375000, (float) $tx->package_price);
        $this->assertEquals(20000, (float) $tx->card_fee);
        $this->assertEquals('qris', $tx->payment_method);

        // Cleanup
        $tx->delete();
        if ($member->user) {
            $member->user->delete();
        }
        $member->delete();
    }

    /**
     * 3. Verifikasi calon member pending (registrasi online -> aktivasi kasir)
     * Otomatis memasukkan biaya kartu fisik Rp20.000 ke transaksi pertama.
     */
    public function test_pending_member_verification_automatically_adds_card_fee_to_invoice(): void
    {
        $admin = User::where('role', 'admin')->first();
        $pkg1Month = Package::where('name', 'Membership 1 Month')->first();
        $uniquePhone = '0814'.rand(10000000, 99999999);
        $tempRegId = 'REG-REV-'.rand(1000, 9999);
        $physicalCardId = '2008'.rand(100, 999);

        // Member mendaftar online (status pending)
        $member = Member::create([
            'card_id' => $tempRegId,
            'name' => 'Calon Member Online Revisi',
            'phone' => $uniquePhone,
            'gender' => 'male',
            'join_date' => today()->toDateString(),
            'current_expiry_date' => today()->toDateString(),
            'status' => 'pending_verification',
            'package_name' => $pkg1Month->name,
        ]);

        // Verifikasi oleh admin kasir
        $response = $this->actingAs($admin)->post(route('admin.members.verify', $member), [
            'card_id' => $physicalCardId,
            'package_id' => $pkg1Month->id,
            'payment_method' => 'qris',
            'checkin_now' => 1,
        ]);

        $response->assertRedirect(route('admin.members.show', $member));
        $member->refresh();

        $this->assertEquals('active', $member->status);
        $this->assertEquals($physicalCardId, $member->card_id);

        $tx = Transaction::where('member_id', $member->id)->first();
        $this->assertNotNull($tx);
        $this->assertEquals(150000, (float) $tx->amount, 'Total tagihan verifikasi member baru harus 130.000 + 20.000 = 150.000');
        $this->assertEquals(130000, (float) $tx->package_price);
        $this->assertEquals(20000, (float) $tx->card_fee);

        // Cleanup
        Attendance::where('member_id', $member->id)->delete();
        $tx->delete();
        if ($member->user) {
            $member->user->delete();
        }
        $member->delete();
    }

    /**
     * 3. Aturan biaya kartu: Biaya kartu TIDAK dikenakan kembali ketika member melakukan perpanjangan.
     */
    public function test_membership_renewal_does_not_charge_card_fee(): void
    {
        $admin = User::where('role', 'admin')->first();
        $pkg1Month = Package::where('name', 'Membership 1 Month')->first();
        $uniquePhone = '0815'.rand(10000000, 99999999);
        $cardId = 'MC-RENEW-'.rand(1000, 9999);

        // Member sudah aktif dan sudah pernah bayar biaya kartu di awal
        $member = Member::create([
            'card_id' => $cardId,
            'name' => 'Member Lama Uji Perpanjang',
            'phone' => $uniquePhone,
            'gender' => 'female',
            'join_date' => today()->subDays(30)->toDateString(),
            'current_expiry_date' => today()->addDays(5)->toDateString(),
            'status' => 'active',
            'package_name' => $pkg1Month->name,
        ]);

        // Transaksi registrasi awal member (pernah ada biaya kartu)
        Transaction::create([
            'invoice_code' => 'INV-FIRST-'.rand(1000, 9999),
            'member_id' => $member->id,
            'package_id' => $pkg1Month->id,
            'customer_name' => $member->name,
            'customer_phone' => $member->phone,
            'amount' => 150000,
            'package_price' => 130000,
            'card_fee' => 20000,
            'payment_method' => 'cash',
            'created_by' => $admin->id,
            'created_at' => today()->subDays(30),
        ]);

        // Lakukan perpanjangan (renewal)
        $renewResponse = $this->actingAs($admin)->post(route('admin.members.renew', $member), [
            'package_id' => $pkg1Month->id,
            'payment_method' => 'transfer',
        ]);

        $renewResponse->assertRedirect();
        $renewResponse->assertSessionHas('success');

        // Transaksi perpanjangan harus bernilai murni harga paket (Rp130.000) TANPA biaya kartu
        $renewalTx = Transaction::where('member_id', $member->id)->latest('created_at')->first();
        $this->assertNotNull($renewalTx);
        $this->assertEquals(130000, (float) $renewalTx->amount, 'Perpanjangan tidak boleh dikenakan biaya kartu');
        $this->assertEquals(130000, (float) $renewalTx->package_price);
        $this->assertEquals(0, (float) $renewalTx->card_fee);

        // Cleanup
        Transaction::where('member_id', $member->id)->delete();
        if ($member->user) {
            $member->user->delete();
        }
        $member->delete();
    }

    /**
     * 3. Pencegahan duplikasi biaya kartu dan transaksi saat refresh atau repeat submit.
     */
    public function test_prevent_duplicate_card_fee_and_duplicate_transaction_on_refresh(): void
    {
        $admin = User::where('role', 'admin')->first();
        $pkg1Month = Package::where('name', 'Membership 1 Month')->first();
        $uniquePhone = '0816'.rand(10000000, 99999999);
        $cardId = 'MC-NODUP-'.rand(1000, 9999);

        $member = Member::create([
            'card_id' => $cardId,
            'name' => 'Member No Duplikasi',
            'phone' => $uniquePhone,
            'gender' => 'male',
            'join_date' => today()->toDateString(),
            'current_expiry_date' => today()->toDateString(),
            'status' => 'pending_verification',
            'package_name' => $pkg1Month->name,
        ]);

        // Verifikasi pertama kali
        $this->actingAs($admin)->post(route('admin.members.verify', $member), [
            'card_id' => $cardId,
            'package_id' => $pkg1Month->id,
            'payment_method' => 'cash',
        ]);

        $this->assertEquals(1, Transaction::where('member_id', $member->id)->count());

        // Verifikasi kedua (simulasi refresh halaman atau ulangi submit oleh user)
        $repeatResponse = $this->actingAs($admin)->post(route('admin.members.verify', $member), [
            'card_id' => $cardId,
            'package_id' => $pkg1Month->id,
            'payment_method' => 'cash',
        ]);

        // Tetap hanya ada 1 transaksi (tidak terjadi double charge / double invoice)
        $repeatResponse->assertRedirect(route('admin.members.show', $member));
        $this->assertEquals(1, Transaction::where('member_id', $member->id)->count());

        // Cleanup
        Transaction::where('member_id', $member->id)->delete();
        if ($member->user) {
            $member->user->delete();
        }
        $member->delete();
    }

    /**
     * 4. Penyesuaian tampilan invoice transparan pada profil member (riwayat transaksi).
     */
    public function test_member_show_page_displays_transparent_invoice_breakdown(): void
    {
        $admin = User::where('role', 'admin')->first();
        $pkg = Package::where('name', 'Membership 1 Month')->first();
        $member = Member::where('status', 'active')->first();

        // Buat satu transaksi dengan rincian
        $invoiceCode = 'INV-TEST-SHOW-'.rand(100, 999);
        $tx = Transaction::create([
            'invoice_code' => $invoiceCode,
            'member_id' => $member->id,
            'package_id' => $pkg->id,
            'customer_name' => $member->name,
            'customer_phone' => $member->phone,
            'amount' => 150000,
            'package_price' => 130000,
            'card_fee' => 20000,
            'payment_method' => 'qris',
            'created_by' => $admin->id,
            'created_at' => now(),
        ]);

        $response = $this->actingAs($admin)->get(route('admin.members.show', $member));
        $response->assertStatus(200);

        // Verifikasi rincian invoice transparan ditampilkan
        $response->assertSee($invoiceCode);
        $response->assertSee('Paket Membership');
        $response->assertSee('Rp 130.000');
        $response->assertSee('Kartu Member');
        $response->assertSee('Rp 20.000');
        $response->assertSee('Total Pembayaran');
        $response->assertSee('Rp 150.000');

        $tx->delete();
    }

    /**
     * 6. Batasan pengerjaan: Tarif insidentil dan Personal Trainer tidak berubah.
     */
    public function test_pt_and_daily_visit_pricing_remain_untouched(): void
    {
        // Insidentil / Daily Pass tetap Rp25.000 / Rp30.000
        $membershipDetail = $this->get(route('pricing.membership'));
        $membershipDetail->assertSee('Insidentil');
        $membershipDetail->assertSee('Rp 30.000');

        // PT Single tidak berubah
        $ptSingle = $this->get(route('pricing.pt-single'));
        $ptSingle->assertSee('Rp 130.000'); // 1 PT Single
        $ptSingle->assertSee('Rp 520.000'); // 4 PT Single
        $ptSingle->assertSee('Rp 950.000'); // 8 PT Single

        // PT Couples tidak berubah
        $ptCouples = $this->get(route('pricing.pt-couples'));
        $ptCouples->assertSee('Rp 210.000'); // 1 PT Couples
        $ptCouples->assertSee('Rp 950.000'); // 4 PT Couples
        $ptCouples->assertSee('Rp 1.200.000'); // 8 PT Couples
    }
}
