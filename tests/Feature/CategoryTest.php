<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;



class CategoryTest extends TestCase
{
    use RefreshDatabase;

        private function authenticateAdmin()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin'); // Guard admin
        return $admin;
    }

    /** @test */
    public function it_displays_category_view_page()
    {
        $this->authenticateAdmin();

        $category = Category::factory()->create(['category_name_fr' => 'Test Cat']);

        $response = $this->get('/category/view');
        $response->assertStatus(200);
        $response->assertSee($category->category_name_fr);
    }

    /** @test */
    public function it_stores_category_with_image()
    {
        $this->authenticateAdmin();

        Storage::fake('public');
        $image = UploadedFile::fake()->image('category.jpg');

        // Mock Intervention Image
        $mock = Mockery::mock('alias:Intervention\Image\Facades\Image');
        $mock->shouldReceive('make')->once()->andReturnSelf();
        $mock->shouldReceive('fit')->once()->andReturnSelf();
        $mock->shouldReceive('save')->once()->andReturn(true);

        $response = $this->post('/category/store', [
            'category_name_fr' => 'Catégorie Test',
            'category_image' => $image,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('message', 'Categorie insérer avec succès');
        $this->assertDatabaseHas('categories', ['category_name_fr' => 'Catégorie Test']);
    }

    /** @test */
    public function it_stores_category_without_image()
    {
        $this->authenticateAdmin();

        $response = $this->post('/category/store', [
            'category_name_fr' => 'Catégorie Sans Image'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('message', 'Categorie insérer avec succès');
        $this->assertDatabaseHas('categories', ['category_name_fr' => 'Catégorie Sans Image']);
    }

    /** @test */
    public function it_requires_category_name_fr()
    {
        $this->authenticateAdmin();

        $response = $this->post('/category/store', []);
        $response->assertSessionHasErrors(['category_name_fr']);
    }

    /** @test */
    public function it_displays_category_edit_page()
    {
        $this->authenticateAdmin();

        $category = Category::factory()->create();

        $response = $this->get("/category/edit/{$category->id}");
        $response->assertStatus(200);
        $response->assertSee($category->category_name_fr);
    }

    /** @test */
    public function it_updates_category_with_image()
    {
        $this->authenticateAdmin();

        Storage::fake('public');
        $oldCategory = Category::factory()->create();

        $image = UploadedFile::fake()->image('new.jpg');

        // Mock Intervention Image
        $mock = Mockery::mock('alias:Intervention\Image\Facades\Image');
        $mock->shouldReceive('make')->once()->andReturnSelf();
        $mock->shouldReceive('fit')->once()->andReturnSelf();
        $mock->shouldReceive('save')->once()->andReturn(true);

        $response = $this->post('/category/update', [
            'id' => $oldCategory->id,
            'category_name_fr' => 'Updated Cat',
            'category_image' => $image,
            'old_img' => null,
        ]);

        $response->assertRedirect(route('all.category'));
        $response->assertSessionHas('message', 'Categorie Mise a jour Succes');
        $this->assertDatabaseHas('categories', ['category_name_fr' => 'Updated Cat']);
    }

    /** @test */
    public function it_updates_category_without_image()
    {
        $this->authenticateAdmin();

        $category = Category::factory()->create(['category_name_fr' => 'Old Name']);

        $response = $this->post('/category/update', [
            'id' => $category->id,
            'category_name_fr' => 'New Name',
            'old_img' => null,
        ]);

        $response->assertRedirect(route('all.category'));
        $response->assertSessionHas('message', 'Categorie Mise a jour Succes');
        $this->assertDatabaseHas('categories', ['category_name_fr' => 'New Name']);
    }

    /** @test */
    public function it_deletes_category()
    {
        $this->authenticateAdmin();

        $category = Category::factory()->create();

        $response = $this->get("/category/delete/{$category->id}");

        $response->assertRedirect(route('all.category'));
        $response->assertSessionHas('message', 'Categorie supprime avec Succes');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

}
