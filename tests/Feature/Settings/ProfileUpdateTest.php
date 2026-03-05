<?php

namespace Tests\Feature\Settings;

use App\Livewire\Settings\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/settings/profile');

        $response->assertStatus(200);
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = Livewire::test(Profile::class)
            ->set('name', 'Test User')
            ->set('surname', 'Test Surname')
            ->set('dni', '12345678')
            ->set('cellphone', '3001234567')
            ->set('address', 'Test Address 123')
            ->set('email', 'admin@viaticos.com')
            ->call('updateProfileInformation');

        $response->assertHasNoErrors();

        $user->refresh();

        $this->assertEquals('Test User', $user->name);
        $this->assertEquals('Test Surname', $user->surname);
        $this->assertEquals('12345678', $user->dni);
        $this->assertEquals('3001234567', $user->cellphone);
        $this->assertEquals('Test Address 123', $user->address);
        $this->assertEquals('admin@viaticos.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = Livewire::test(Profile::class)
            ->set('name', 'Test User')
            ->set('surname', 'Test Surname')
            ->set('dni', '12345678')
            ->set('cellphone', '3001234567')
            ->set('address', 'Test Address 123')
            ->set('email', $user->email)
            ->call('updateProfileInformation');

        $response->assertHasNoErrors();

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = Livewire::test('settings.delete-user-form')
            ->set('password', 'password')
            ->call('deleteUser');

        $response
            ->assertHasNoErrors()
            ->assertRedirect('/');

        $this->assertNull($user->fresh());
        $this->assertGuest();
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = Livewire::test('settings.delete-user-form')
            ->set('password', 'wrong-password')
            ->call('deleteUser');

        $response->assertHasErrors(['password']);

        $this->assertNotNull($user->fresh());
    }

    public function test_all_required_fields_must_be_provided(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = Livewire::test(Profile::class)
            ->set('name', '')
            ->set('surname', '')
            ->set('dni', '')
            ->set('cellphone', '')
            ->set('address', '')
            ->set('email', 'test@example.com')
            ->call('updateProfileInformation');

        $response->assertHasErrors(['name', 'surname', 'dni', 'cellphone', 'address']);
    }

    public function test_dni_must_be_unique(): void
    {
        // Crear primer usuario con DNI
        $existingUser = User::factory()->create(['dni' => '12345678']);

        // Crear segundo usuario
        $user = User::factory()->create(['dni' => '87654321']);

        $this->actingAs($user);

        // Intentar usar DNI del primer usuario
        $response = Livewire::test(Profile::class)
            ->set('name', 'Test User')
            ->set('surname', 'Test Surname')
            ->set('dni', '12345678') // DNI duplicado
            ->set('cellphone', '3001234567')
            ->set('address', 'Test Address 123')
            ->set('email', 'test@example.com')
            ->call('updateProfileInformation');

        $response->assertHasErrors(['dni']);
    }

    public function test_user_can_keep_same_dni_when_updating_profile(): void
    {
        $user = User::factory()->create(['dni' => '12345678']);

        $this->actingAs($user);

        // Usuario debe poder mantener su propio DNI al actualizar
        $response = Livewire::test(Profile::class)
            ->set('name', 'Updated Name')
            ->set('surname', 'Updated Surname')
            ->set('dni', '12345678') // Mismo DNI
            ->set('cellphone', '3001234567')
            ->set('address', 'Updated Address')
            ->set('email', $user->email)
            ->call('updateProfileInformation');

        $response->assertHasNoErrors();

        $user->refresh();
        $this->assertEquals('Updated Name', $user->name);
        $this->assertEquals('12345678', $user->dni);
    }
}
