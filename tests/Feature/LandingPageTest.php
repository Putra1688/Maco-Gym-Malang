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

        // Navbar & Brand & Logo
        $response->assertSee('MACO');
        $response->assertSee('GYM');
        $response->assertSee('images/logo/macogym.jpg');

        // Hero Section (Matching Reference: Become The Best Version Of Yourself)
        $response->assertSee('BEST VERSION');
        $response->assertSee('TRAIN HARD. STAY STRONG.');

        // Facilities & Programs Section
        $response->assertSee('OUR PROGRAMS');
        $response->assertSee('STRENGTH TRAINING');
        $response->assertSee('JELAJAHI FASILITAS & PROGRAM LENGKAP');

        // About & Philosophy Section
        $response->assertSee('DISCIPLINE');
        $response->assertSee('CONSISTENT');
        $response->assertSee('ABOUT MACO GYM');

        // Testimonials Section
        $response->assertSee('WHAT OUR MEMBERS SAY');

        // Pricing Section (3 Main Categories: Membership, PT Single, PT Couples)
        $response->assertSee('CHOOSE YOUR');
        $response->assertSee('PLAN');
        $response->assertSee('MEMBERSHIP');
        $response->assertSee('PERSONAL TRAINER SINGLE');
        $response->assertSee('PERSONAL TRAINER COUPLES');

        // Personal Trainer Section
        $response->assertSee('Coach Rangga Pratama');
        $response->assertSee('Coach Kevin Ardian');

        // Cara Daftar Section
        $response->assertSee('CARA DAFTAR MEMBER');

        // FAQ Section
        $response->assertSee('FREQUENTLY ASKED QUESTIONS');

        // Pre-Footer Banner & Footer Section
        $response->assertSee('READY TO REACH YOUR PEAK?');
        $response->assertSee('Lowokwaru, Kota Malang');
    }

    /**
     * Test that the register page renders correctly.
     */
    public function test_register_page_renders_correctly(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Bergabung');
        $response->assertSee('Maco Gym');
        $response->assertSee('Pendaftaran');
        $response->assertSee('Alamat Domisili');
        $response->assertSee('KIRIM PENDAFTARAN KE WHATSAPP ADMIN');
    }

    /**
     * Test that the BMI page renders correctly.
     */
    public function test_bmi_page_renders_correctly(): void
    {
        $response = $this->get('/kalkulator-bmi');

        $response->assertStatus(200);
        $response->assertSee('Tentang');
        $response->assertSee('BMI');
        $response->assertSee('Hitung BMI');
        $response->assertSee('Cara Cek BMI');
    }

    /**
     * Test that the facilities & programs page renders correctly.
     */
    public function test_facilities_page_renders_correctly(): void
    {
        $response = $this->get('/fasilitas');

        $response->assertStatus(200);
        $response->assertSee('FASILITAS LENGKAP &');
        $response->assertSee('PROGRAM LATIHAN');
        $response->assertSee('Free Weights Zone');
        $response->assertSee('Plate-Loaded Machines');
        $response->assertSee('Cardio Theater');
        $response->assertSee('Locker & Hot Shower');
        $response->assertSee('Musholla Ber-AC');
        $response->assertSee('Strength & Powerbuilding');
        $response->assertSee('DAFTAR MEMBER SEKARANG');
    }
}
