<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\Admin;
use App\Mail\EmailVerifMail;
use App\Mail\PasswordMail;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_admin_successfully()
    {
        $response = $this->post(route('admin.create'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret123',
        ]);

        $this->assertDatabaseHas('admins', [
            'email' => 'john@example.com'
        ]);

        $response->assertRedirect(route('admin.login'));
        $response->assertSessionHas('success', 'admin insere Succes');
    }

    /** @test */
    public function it_fails_if_email_does_not_exist_on_check()
    {
        $response = $this->post(route('admin.check'), [
            'email' => 'notfound@test.com'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('message', 'Votre Email est introuvable');
    }

        /** @test */
    public function it_sends_verification_email_on_check()
    {
        Mail::fake();

        $admin = Admin::factory()->create([
            'email' => 'test@test.com'
        ]);

        $response = $this->post(route('admin.check'), [
            'email' => 'test@test.com'
        ]);

        $response->assertRedirect(route('admin.email-code'));
        $response->assertSessionHas('message', 'Vérifier votre boite mail');

        Mail::assertSent(EmailVerifMail::class, function ($mail) use ($admin) {
            return $mail->hasTo($admin->email);
        });

        $this->assertNotNull(Admin::first()->code);
    }

    /** @test */
    public function it_logs_in_with_valid_code()
    {
        $admin = Admin::factory()->create([
            'code' => '12345'
        ]);

        $response = $this->post(route('admin.code-check'), [
            'code' => '12345'
        ]);

        $this->assertAuthenticatedAs($admin, 'admin');
        $response->assertRedirect('/admin/dashboard');
    }

    /** @test */
    public function it_displays_profile_page_for_authenticated_admin()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.profile'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.pages.profile.admin_profile');
        $response->assertViewHas('admindata', $admin);
    }

    /** @test */
    public function it_displays_edit_profile_page_for_authenticated_admin()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.profile_edit'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.pages.profile.admin_profile_edit');
        $response->assertViewHas('editdata', $admin);
    }

    /** @test */
    public function it_updates_profile_without_password()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->post(route('admin.profile_store'), [
            'id' => $admin->id,
            'name' => 'Updated Name',
            'email' => 'updated@test.com'
        ]);

        $response->assertRedirect(route('admin.profile'));
        $this->assertDatabaseHas('admins', [
            'id' => $admin->id,
            'name' => 'Updated Name',
            'email' => 'updated@test.com'
        ]);
    }

    /** @test */
    public function it_updates_profile_and_logs_out_when_password_changed()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->post(route('admin.profile_store'), [
            'id' => $admin->id,
            'name' => 'New Name',
            'email' => 'new@test.com',
            'password' => 'newpassword123'
        ]);

        $response->assertRedirect(route('admin.login'));
        $this->assertDatabaseHas('admins', [
            'id' => $admin->id,
            'name' => 'New Name',
            'email' => 'new@test.com'
        ]);

        $this->assertFalse(Auth::guard('admin')->check());
    }


    /** @test */
    public function it_resets_password_and_logs_in()
    {
        $admin = Admin::factory()->create([
            'code' => 'resetcode'
        ]);

        $response = $this->post(route('admin.reset'), [
            'code' => 'resetcode',
            'password' => 'newpassword123'
        ]);

        $this->assertTrue(Hash::check('newpassword123', Admin::first()->password));
        $this->assertAuthenticatedAs($admin, 'admin');
        $response->assertRedirect('/admin/dashboard');
    }


    /** @test */
    public function it_logs_out_admin()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));

    }
}
