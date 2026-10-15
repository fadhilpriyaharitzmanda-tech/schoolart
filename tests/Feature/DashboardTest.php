<?php

namespace Tests\Feature;

use Database\Seeders\CurriculumSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CurriculumSeeder::class);
    }

    /**
     * Test the student dashboard renders successfully.
     */
    public function test_dashboard_renders_successfully(): void
    {
        $response = $this->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('AI Tutor Belajar SMK');
        $response->assertSee('Kuis Harian Cepat');
        $response->assertSee('Target Belajar SMK');
        $response->assertSee('Modul & Dokumen Rekomendasi', false);
        $response->assertSee('images/subjects/pbo.jpg');
    }
}
