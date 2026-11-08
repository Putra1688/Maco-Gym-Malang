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
        $response->assertSee('Free Weights Zone');

        // About & Philosophy Section
        $response->assertSee('DISCIPLINE');
        $response->assertSee('CONSISTENT');
        $response->assertSee('ABOUT MACO GYM');

        // Testimonials Section
        $response->assertSee('WHAT OUR MEMBERS SAY');

        // Pricing Section (Bulanan, Mahasiswa, Personal Trainer)
        $response->assertSee('CHOOSE YOUR PLAN');
        $response->assertSee('1 Bulan Reguler');
        $response->assertSee('1 Bulan Mahasiswa');
        $response->assertSee('PT 12 Sesi');

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
}
