<?php

namespace Tests\Feature;

use Tests\TestCase;

class LandingPageTest extends TestCase
{
    /**
     * Test that the landing page renders with all required sections.
     */
    public function test_landing_page_renders_all_required_sections(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Navbar & Brand
        $response->assertSee('MACO');
        $response->assertSee('GYM');

        // Hero Section
        $response->assertSee('Bentuk Tubuh');
        $response->assertSee('Maco Gym');

        // Facilities Section
        $response->assertSee('Fasilitas Lengkap');
        $response->assertSee('Free Weights Zone');
        $response->assertSee('Cardio Theater');
        $response->assertSee('Locker');
        $response->assertSee('Shower');

        // Pricing Section (Bulanan, Mahasiswa, Personal Trainer)
        $response->assertSee('1 Bulan Reguler');
        $response->assertSee('1 Bulan Mahasiswa');
        $response->assertSee('PT 5 Sesi');
        $response->assertSee('PT 12 Sesi');

        // Personal Trainer Section
        $response->assertSee('Coach Rangga Pratama');
        $response->assertSee('Coach Kevin Ardian');

        // Cara Daftar Section
        $response->assertSee('Cara Daftar Member');
        $response->assertSee('Formulir Registrasi Cepat');

        // FAQ Section
        $response->assertSee('Frequently Asked Questions');

        // Footer Section
        $response->assertSee('Lowokwaru, Kota Malang');
        $response->assertSee('Jam Operasional');
    }
}
