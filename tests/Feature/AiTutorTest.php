<?php

namespace Tests\Feature;

use App\Models\Subject;
use Database\Seeders\CurriculumSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AiTutorTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CurriculumSeeder::class);
    }

    /**
     * Test dedicated AI Tutor page renders correctly.
     */
    public function test_ai_tutor_page_can_be_rendered(): void
    {
        $response = $this->get(route('ai.index'));

        $response->assertStatus(200);
        $response->assertSee('Pak Guru AI');
        $response->assertSee('Tutor Belajar SMK');
        $response->assertSee('Otomatis Tanya');
    }

    /**
     * Test all 4 mandatory smart prompts are present on the page.
     */
    public function test_ai_tutor_page_contains_the_four_mandatory_smart_prompts(): void
    {
        $response = $this->get(route('ai.index'));

        $response->assertStatus(200);
        $response->assertSee('Tolong jelaskan konsep ini dengan analogi sederhana.');
        $response->assertSee('Buatkan 3 soal latihan beserta kunci jawabannya.');
        $response->assertSee('Bagian apa yang paling sering keluar di ujian?');
        $response->assertSee('Berikan contoh penerapan nyata di dunia kerja/industri.');
    }

    /**
     * Test AI chat API responds with simple analogy for prompt 1.
     */
    public function test_ai_chat_api_responds_with_analogy(): void
    {
        $subject = Subject::where('slug', 'pemrograman-berorientasi-objek')->firstOrFail();

        $response = $this->postJson(route('ai.chat'), [
            'message' => 'Tolong jelaskan konsep ini dengan analogi sederhana.',
            'subject_slug' => $subject->slug,
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);
        $response->assertSee('analogi', false);
    }

    /**
     * Test AI chat API responds with 3 practice questions for prompt 2.
     */
    public function test_ai_chat_api_responds_with_three_practice_questions(): void
    {
        $response = $this->postJson(route('ai.chat'), [
            'message' => 'Buatkan 3 soal latihan beserta kunci jawabannya.',
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);
        $response->assertSee('Soal 1', false);
        $response->assertSee('Soal 2', false);
        $response->assertSee('Soal 3', false);
        $response->assertSee('Kunci Jawaban', false);
    }

    /**
     * Test AI chat API responds with exam tips for prompt 3.
     */
    public function test_ai_chat_api_responds_with_exam_insights(): void
    {
        $response = $this->postJson(route('ai.chat'), [
            'message' => 'Bagian apa yang paling sering keluar di ujian?',
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);
        $response->assertSee('Paling Sering', false);
    }

    /**
     * Test AI chat API responds with real-world industry cases for prompt 4.
     */
    public function test_ai_chat_api_responds_with_industry_applications(): void
    {
        $response = $this->postJson(route('ai.chat'), [
            'message' => 'Berikan contoh penerapan nyata di dunia kerja/industri.',
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);
        $response->assertSee('dunia kerja nyata', false);
    }
}
