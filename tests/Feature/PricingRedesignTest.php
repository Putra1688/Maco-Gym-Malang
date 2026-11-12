<?php

namespace Tests\Feature;

use Tests\TestCase;

class PricingRedesignTest extends TestCase
{
    /**
     * Test landing page only shows 3 main category cards with links to detail pages.
     */
    public function test_landing_page_shows_three_pricing_categories_without_overcrowding(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Header and subtitle
        $response->assertSee('OFFICIAL PRICE LIST');
        $response->assertSee('CHOOSE YOUR');
        $response->assertSee('PLAN');

        // 3 Main Categories
        $response->assertSee('MEMBERSHIP');
        $response->assertSee('Pilihan keanggotaan gym untuk reguler, mahasiswa, dan pelajar.');
        $response->assertSee(route('pricing.membership'));

        $response->assertSee('PERSONAL TRAINER SINGLE');
        $response->assertSee('Program latihan personal dengan satu trainer untuk satu orang.');
        $response->assertSee(route('pricing.pt-single'));

        $response->assertSee('PERSONAL TRAINER COUPLES');
        $response->assertSee('Program latihan personal untuk dua orang bersama satu trainer.');
        $response->assertSee(route('pricing.pt-couples'));

        // Action CTA on each card
        $response->assertSee('LIHAT DETAIL PAKET');
    }

    /**
     * Test membership detail page has all official pricing and groupings.
     */
    public function test_membership_detail_page_has_official_prices_and_categories(): void
    {
        $response = $this->get(route('pricing.membership'));

        $response->assertStatus(200);

        // Group 1: Reguler
        $response->assertSee('1. Membership Reguler');
        $response->assertSee('1 Month');
        $response->assertSee('Rp 130.000');
        $response->assertSee('3 Month');
        $response->assertSee('Rp 375.000');
        $response->assertSee('6 Month');
        $response->assertSee('Rp 750.000');
        $response->assertSee('12 Month');
        $response->assertSee('Rp 1.450.000');

        // Group 2: Pelajar & Mahasiswa
        $response->assertSee('2. Membership Khusus Pelajar dan Mahasiswa');
        $response->assertSee('Mahasiswa');
        $response->assertSee('Rp 110.000');
        $response->assertSee('Pelajar (maksimal SMA)');
        $response->assertSee('Rp 100.000');
        $response->assertSee('KTM aktif');

        // Group 3: Biaya Tambahan / Insidentil
        $response->assertSee('3. Biaya Tambahan / Insidentil');
        $response->assertSee('Regular Membership (Joining Fee)');
        $response->assertSee('Rp 20.000');
        $response->assertSee('Insidentil');
        $response->assertSee('Rp 30.000');

        // WhatsApp CTA
        $response->assertSee('https://wa.me/6281250207403');
    }

    /**
     * Test personal trainer single detail page has official prices and duration notice.
     */
    public function test_pt_single_detail_page_has_official_prices_and_conditions(): void
    {
        $response = $this->get(route('pricing.pt-single'));

        $response->assertStatus(200);

        // 1-on-1 info & official notice
        $response->assertSee('PERSONAL TRAINER');
        $response->assertSee('SINGLE');
        $response->assertSee('Durasi latihan 1–1,5 jam per kedatangan');
        $response->assertSee('1 orang dengan 1 trainer');

        // Prices & validity days
        $response->assertSee('1 PT (Single)');
        $response->assertSee('Rp 130.000');

        $response->assertSee('4 PT (Single)');
        $response->assertSee('Rp 520.000');
        $response->assertSee('10 hari');

        $response->assertSee('8 PT (Single)');
        $response->assertSee('Rp 950.000');
        $response->assertSee('20 hari');

        $response->assertSee('12 PT (Single)');
        $response->assertSee('Rp 1.150.000');
        $response->assertSee('30 hari');

        $response->assertSee('16 PT (Single)');
        $response->assertSee('Rp 1.450.000');
        $response->assertSee('40 hari');

        $response->assertSee('20 PT (Single)');
        $response->assertSee('Rp 1.850.000');
        $response->assertSee('50–60 hari');

        // WhatsApp CTA
        $response->assertSee('https://wa.me/6281250207403');
    }

    /**
     * Test personal trainer couples detail page has official prices and duration notice.
     */
    public function test_pt_couples_detail_page_has_official_prices_and_conditions(): void
    {
        $response = $this->get(route('pricing.pt-couples'));

        $response->assertStatus(200);

        // Duo info & official notice
        $response->assertSee('PERSONAL TRAINER');
        $response->assertSee('COUPLES');
        $response->assertSee('Durasi latihan 1–1,5 jam per kedatangan');
        $response->assertSee('dua orang bersama satu personal trainer');

        // Prices & validity days
        $response->assertSee('1 PT (Couples)');
        $response->assertSee('Rp 210.000');

        $response->assertSee('4 PT (Couples)');
        $response->assertSee('Rp 950.000');
        $response->assertSee('15 hari');

        $response->assertSee('8 PT (Couples)');
        $response->assertSee('Rp 1.200.000');
        $response->assertSee('30 hari');

        $response->assertSee('12 PT (Couples)');
        $response->assertSee('Rp 1.850.000');

        $response->assertSee('16 PT (Couples)');
        $response->assertSee('Rp 2.150.000');
        $response->assertSee('40 hari');

        $response->assertSee('20 PT (Couples)');
        $response->assertSee('Rp 2.650.000');
        $response->assertSee('60 hari');

        // WhatsApp CTA
        $response->assertSee('https://wa.me/6281250207403');
    }

    /**
     * Test CTA links carry the selected package to the registration page.
     */
    public function test_package_preselection_in_registration_form(): void
    {
        $response = $this->get(route('register', ['package' => '4 PT (Single) - Rp 520.000']));
        $response->assertStatus(200);
        $response->assertSee('selected', false);
        $response->assertSee('4 PT Single Session (Rp 520.000 - 10 Hari)');

        $couplesResponse = $this->get(route('register', ['package' => '8 PT (Couples) - Rp 1.200.000']));
        $couplesResponse->assertStatus(200);
        $couplesResponse->assertSee('8 PT Couples Session (Rp 1.200.000 - 30 Hari)');
    }
}
