<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- Caso 1: Actualizar un usuario específico por su email ---
        $userToUpdate = User::where('email', 'jose_lopez@example.com')->first();

        // Es una buena práctica verificar si el usuario fue encontrado
        if ($userToUpdate) {
            $userToUpdate->update([
                'password' => Hash::make('Josepass'),
                'email_verified_at' => now(),
            ]);
            
            // Opcional: Muestra un mensaje en la consola
            $this->command->info('Contraseña actualizada para admin@adlerreservas.com');
        } else {
            $this->command->warn('No se encontró el usuario admin@adlerreservas.com para actualizar.');
        }
    }
}
