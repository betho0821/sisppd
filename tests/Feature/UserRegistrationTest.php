<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test que un administrador puede registrar un nuevo usuario.
     *
     * @return void
     */
    public function test_admin_can_register_new_user()
    {
        // Crear un usuario con rol de Administrador
        $admin = User::factory()->create([
            'role' => 'Administrador',
        ]);

        // Actuar como ese usuario administrador
        $this->actingAs($admin);

        // Enviar solicitud POST a la ruta de registro
        $response = $this->post('/register', [
            'name' => 'Nuevo Usuario',
            'email' => 'nuevo@usuario.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Verificar que el usuario fue registrado y redirigido
        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', [
            'email' => 'nuevo@usuario.com',
        ]);
    }

    /**
     * Test que un agente no puede acceder a la ruta de registro.
     *
     * @return void
     */
    public function test_agent_cannot_access_register_route()
    {
        // Crear un usuario con rol de Agente
        $agent = User::factory()->create([
            'role' => 'Agente',
        ]);

        // Actuar como ese usuario agente
        $this->actingAs($agent);

        // Intentar acceder a la página de registro
        $response = $this->get('/register');

        // Verificar que se redirige al home o a otra página
        $response->assertRedirect('/');
    }
}
