<?php

namespace Tests\Feature;

use Database\Seeders\CurriculumSeeder;
use Database\Seeders\ScheduleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CurriculumSeeder::class);
        $this->seed(ScheduleSeeder::class);
    }

    /**
     * Test weekly schedule index page renders correctly.
     */
    public function test_weekly_schedule_page_can_be_rendered(): void
    {
        $response = $this->get(route('jadwal.index'));

        $response->assertStatus(200);
        $response->assertSee('Jadwal Pelajaran Sekolah');
        $response->assertSee('Senin');
        $response->assertSee('Selasa');
        $response->assertSee('Rabu');
        $response->assertSee('Kamis');
        $response->assertSee('Jumat');
        $response->assertSee('Jam Pelajaran');
    }

    /**
     * Test schedule simulation highlights currently active slot.
     */
    public function test_schedule_page_highlights_active_lesson_in_simulation(): void
    {
        // Simulate Monday at 08:30 WIB (PBO lesson slot)
        $response = $this->get(route('jadwal.index', [
            'sim_day' => 1,
            'sim_time' => '08:30',
        ]));

        $response->assertStatus(200);
        $response->assertSee('SEDANG BERLANGSUNG SAAT INI');
        $response->assertSee('Pemrograman Berorientasi Objek');
        $response->assertSee('Lab Rekayasa Perangkat Lunak 1');
        $response->assertSee('Mode Simulasi');
    }

    /**
     * Test live active slot API returns JSON.
     */
    public function test_schedule_active_api_endpoint_returns_json(): void
    {
        $response = $this->getJson(route('jadwal.active', [
            'day' => 1,
            'time' => '08:30',
        ]));

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'day_of_week' => 1,
            'server_time' => '08:30',
            'has_active' => true,
        ]);
        $response->assertJsonPath('active_slot.subject_name', 'Pemrograman Berorientasi Objek (PBO)');
    }

    /**
     * Test active slot API when outside school hours.
     */
    public function test_schedule_active_api_returns_false_outside_hours(): void
    {
        $response = $this->getJson(route('jadwal.active', [
            'day' => 1,
            'time' => '22:00',
        ]));

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'has_active' => false,
            'active_slot' => null,
        ]);
    }
}
