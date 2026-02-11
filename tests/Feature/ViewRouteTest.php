<?php

namespace Tests\Feature;

use App\Models\About;
use App\Models\Currency;
use Illuminate\Foundation\Testing\WithFaker;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewRouteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test que la page "À propos" s'affiche correctement.
     */
    public function test_about_page_loads_successfully()
    {
        Currency::factory()->create(['id' => 4]);
        About::factory()->create();
        $response = $this->get('/about');
        $response->assertStatus(200);
        $response->assertViewIs('frontend.pages.about.about');
    }

    /**
     * Test que la page "Notre vision" s'affiche correctement.
     */
    public function test_vision_page_loads_successfully()
    {
        Currency::factory()->create(['id' => 4]);
        About::factory()->create();
        $response = $this->get('/our-vision');
        $response->assertStatus(200);
        $response->assertViewIs('frontend.pages.about.vision');
    }

    /**
     * Test que la page "Notre mission" s'affiche correctement.
     */
    public function test_mission_page_loads_successfully()
    {
        Currency::factory()->create(['id' => 4]);
        About::factory()->create();
        $response = $this->get('/our-mission');
        $response->assertStatus(200);
        $response->assertViewIs('frontend.pages.about.mission');
    }

    /**
     * Test que la page des avantages s'affiche correctement.
     */
    public function test_advantages_page_loads_successfully()
    {
        Currency::factory()->create(['id' => 4]);
        About::factory()->create();
        $response = $this->get('/advantages');
        $response->assertStatus(200);
        $response->assertViewIs('frontend.pages.about.advantage');
    }

    /**
     * Test que la page des mentions légales s'affiche correctement.
     */
    public function test_mentions_legales_page_loads_successfully()
    {
        Currency::factory()->create(['id' => 4]);
        About::factory()->create();
        $response = $this->get('/mentions-legales');
        $response->assertStatus(200);
        $response->assertViewIs('frontend.pages.about.mention');
    }

    /**
     * Test que la page termes & conditions s'affiche correctement.
     */
    public function test_termes_conditions_page_loads_successfully()
    {

        Currency::factory()->create(['id' => 4]);
        About::factory()->create();
        $response = $this->get('/termes-conditions');
        $response->assertStatus(200);
        $response->assertViewIs('frontend.pages.about.terme');
    }
}
