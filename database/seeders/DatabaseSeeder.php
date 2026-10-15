<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Creamos el Administrador (activo por defecto)
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@grupoconsumo', 
            'password' => Hash::make('password'),
            'role' => 'admin',  
            'is_active' => true,
        ]);

        // 2. Creamos el Productor y lo guardamos en una variable
        $producer = User::create([
            'name' => 'productor proveedor',
            'email' => 'producer@grupoconsumo', 
            'password' => Hash::make('password'),
            'role' => 'producer',  
            'is_active' => true,
        ]);

        // 3. Creamos el Cliente
        User::create([
            'name' => 'Socio Comprador',
            'email' => 'client@grupoconsumo', 
            'password' => Hash::make('password'),
            'role' => 'client',  
            'is_active' => true,
        ]);

        // 4. Creamos los productos con el user_id y unit_type
        Product::create([
            'user_id' => $producer->id,
            'name' => 'Tomates ecologicos',
            'description' => 'Tomates Fresos de huerta local',
            'price' => 2.50,
            'stock' => 50,
            'unit_type' => 'kg', // <-- ¡Añadido aquí!
            'image' => 'products/tomates.jpg'
        ]);

        Product::create([
            'user_id' => $producer->id,
            'name' => 'naranjas ecologicas',
            'description' => 'naranjas del valle de lecrin guachintonas',
            'price' => 3,
            'stock' => 100,
            'unit_type' => 'kg', // <-- ¡Añadido aquí!
            'image' => 'products/tomates.jpg'
        ]);
    }
}