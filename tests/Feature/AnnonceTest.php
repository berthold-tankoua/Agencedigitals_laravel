<?php

namespace Tests\Feature;


use App\Models\Admin;
use App\Models\Category;
use App\Models\Annonce;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class AnnonceTest extends TestCase
{
     use RefreshDatabase;

    private function authenticateAdmin()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin'); // Si tu utilises un guard admin
        return $admin;
    }

    /** @test */
    public function it_displays_all_annonces_page()
    {
        $this->authenticateAdmin();

        $category = Category::factory()->create();
        $annonce = Annonce::factory()->create(['category_id' => $category->id]);

        $response = $this->get('/annonce/view');

        $response->assertStatus(200);
        $response->assertSee($annonce->titre);
        $response->assertSee($category->category_name_fr);
    }

  

    /** @test */
    public function it_requires_fields_when_storing_an_announcement()
    {
        $this->authenticateAdmin();

        $response = $this->post('/annonce/store', []);

        $response->assertSessionHasErrors(['titre', 'category_id', 'desc']);
    }

    /** @test */
    public function it_displays_edit_page()
    {
        $this->authenticateAdmin();

        $category = Category::factory()->create();
        $annonce = Annonce::factory()->create(['category_id' => $category->id]);

        $response = $this->get("/annonce/edit/{$annonce->id}");

        $response->assertStatus(200);
        $response->assertSee($annonce->titre);
    }

    /** @test */
    public function it_updates_an_announcement()
    {
        $this->authenticateAdmin();

        $category = Category::factory()->create();
        $annonce = Annonce::factory()->create(['category_id' => $category->id, 'titre' => 'Old Titre']);

        $response = $this->post('/annonce/update', [
            'id' => $annonce->id,
            'category_id' => $category->id,
            'titre' => 'New Titre',
            'desc' => 'Nouvelle Description',
            'location' => 'Douala',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('message', 'Annonce mise-à-jour avec succès');

        $this->assertDatabaseHas('annonces', [
            'id' => $annonce->id,
            'titre' => 'New Titre',
            'desc' => 'Nouvelle Description',
        ]);
    }

    /** @test */
    public function it_deletes_an_announcement()
    {
        $this->authenticateAdmin();

        $annonce = Annonce::factory()->create();

        $response = $this->get("/annonce/delete/{$annonce->id}");

        $response->assertRedirect();
        $response->assertSessionHas('message', 'Publication supprime avec Succes');

        $this->assertDatabaseMissing('annonces', ['id' => $annonce->id]);
    }

}
