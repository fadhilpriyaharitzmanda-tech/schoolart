<?php

namespace Tests\Feature;

use App\Models\GradeLevel;
use App\Models\Subject;
use Database\Seeders\CurriculumSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurriculumTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CurriculumSeeder::class);
    }

    /**
     * Test curriculum index directory renders correctly.
     */
    public function test_curriculum_index_page_can_be_rendered(): void
    {
        $response = $this->get(route('kurikulum.index'));

        $response->assertStatus(200);
        $response->assertSee('Kurikulum');
        $response->assertSee('Kelas 10');
        $response->assertSee('Kelas 11');
        $response->assertSee('Kelas 12');
        $response->assertSee('Dasar-Dasar Pengembangan Perangkat Lunak');
    }

    /**
     * Test filtering curriculum by grade and search query.
     */
    public function test_curriculum_index_supports_search_and_filters(): void
    {
        $response = $this->get(route('kurikulum.index', ['q' => 'PBO', 'kategori' => 'kejuruan']));

        $response->assertStatus(200);
        $response->assertSee('Pemrograman Berorientasi Objek (PBO)');
    }

    /**
     * Test specific grade level page can be rendered.
     */
    public function test_grade_level_show_page_can_be_rendered(): void
    {
        $grade = GradeLevel::where('slug', 'kelas-10')->firstOrFail();

        $response = $this->get(route('kurikulum.show', $grade->slug));

        $response->assertStatus(200);
        $response->assertSee('Mata Pelajaran Kelas 10');
        $response->assertSee('Kejuruan');
        $response->assertSee('Muatan Umum');
        $response->assertSee('Dasar-Dasar Pengembangan Perangkat Lunak');
    }

    /**
     * Test subject detail page displays topics, documents, and AI tutor.
     */
    public function test_subject_detail_page_can_be_rendered(): void
    {
        $subject = Subject::where('slug', 'pemrograman-berorientasi-objek')->firstOrFail();
        $grade = $subject->gradeLevel;

        $response = $this->get(route('kurikulum.mapel.show', [$grade->slug, $subject->slug]));

        $response->assertStatus(200);
        $response->assertSee('Pemrograman Berorientasi Objek (PBO)');
        $response->assertSee('PBO-201');
        $response->assertSee('Rangkuman Materi');
        $response->assertSee('Bank Dokumen');
        $response->assertSee('Tanya AI Chatbot Mapel Ini');
        $response->assertSee('Scholart AI');
    }

    /**
     * Test 404 is thrown when grade and subject do not match.
     */
    public function test_subject_detail_returns_404_for_mismatched_grade(): void
    {
        $subject = Subject::where('slug', 'pemrograman-berorientasi-objek')->firstOrFail(); // Kelas 11

        // Access via kelas-10 (mismatched)
        $response = $this->get(route('kurikulum.mapel.show', ['kelas-10', $subject->slug]));

        $response->assertStatus(404);
    }
}
