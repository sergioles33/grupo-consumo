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
        // 1. Creamos o actualizamos el Administrador
        User::updateOrCreate(
            ['email' => 'admin@grupoconsumo'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'role' => 'admin',  
                'is_active' => true,
            ]
        );

        // 2. Creamos o actualizamos el Primer Productor y lo guardamos en variable
        $producer = User::updateOrCreate(
            ['email' => 'producer@grupoconsumo'],
            [
                'name' => 'productor proveedor',
                'password' => Hash::make('password'),
                'role' => 'producer',  
                'is_active' => true,
            ]
        );

        // 3. Creamos o actualizamos el Cliente
        User::updateOrCreate(
            ['email' => 'client@grupoconsumo'],
            [
                'name' => 'Socio Comprador',
                'password' => Hash::make('password'),
                'role' => 'client',  
                'is_active' => true,
            ]
        );

        // 4. Creamos o actualizamos el Cliente de prueba adicional
        User::updateOrCreate(
            ['email' => 'cliente1@gmail.com'],
            [
                'name' => 'prueba',
                'password' => Hash::make('password'),
                'role' => 'client',  
                'is_active' => true,
            ]
        );

        // 5. Creamos o actualizamos el Segundo Productor (Sergio) y lo guardamos en variable
        $producer2 = User::updateOrCreate(
            ['email' => 'productor1@hotmail.com'],
            [
                'name' => 'sergio',
                'password' => Hash::make('password'),
                'role' => 'producer',  
                'is_active' => true,
            ]
        );


        // ==========================================
        // 6. PRODUCTOS ASOCIADOS A LOS PRODUCTORES
        // ==========================================

        // Productos del Primer Productor ($producer)
        Product::updateOrCreate(
            ['name' => 'naranjas ecologicas'],
            [
                'user_id' => $producer->id,
                'description' => 'naranjas del valle de lecrin guachintonas',
                'price' => 1.75,
                'stock' => 100,
                'unit_type' => 'kg',
                'image' => 'images/productos/naranjas.jpg',
            ]
        );

        Product::updateOrCreate(
            ['name' => 'pepinos ecologicos'],
            [
                'user_id' => $producer->id,
                'description' => 'pepino ecologico español de la huerta de granada...',
                'price' => 2.50,
                'stock' => 50,
                'unit_type' => 'kg',
                'image' => 'images/productos/pepinoEspañol.jpg',
            ]
        );

        Product::updateOrCreate(
            ['name' => 'tomates ecologicos pera'],
            [
                'user_id' => $producer->id,
                'description' => 'tomates ecológicos pera de huerta la zubia',
                'price' => 2.50,
                'stock' => 50,
                'unit_type' => 'kg',
                'image' => 'images/productos/tomatePera.jpg',
            ]
        );

        Product::updateOrCreate(
            ['name' => 'pimiento verde'],
            [
                'user_id' => $producer->id,
                'description' => 'pimiento verde tipo italiano ecológico. Huerta de...',
                'price' => 4.00,
                'stock' => 20,
                'unit_type' => 'kg',
                'image' => 'images/productos/pimientoVerdeIta.png',
            ]
        );


        // Productos del Segundo Productor ($producer2 - Sergio)
        Product::updateOrCreate(
            ['name' => 'pan semintegral trigo'],
            [
                'user_id' => $producer2->id,
                'description' => 'pan semi integral de trigo con harinas ecologicas...',
                'price' => 4.30,
                'stock' => 100,
                'unit_type' => 'kg',
                'image' => 'images/productos/panSemiTrigo.jpg',
            ]
        );

        Product::updateOrCreate(
            ['name' => 'pan espelta semiintegral'],
            [
                'user_id' => $producer2->id,
                'description' => 'pan de espelta semi integral con harinas ecológicas...',
                'price' => 5.00,
                'stock' => 100,
                'unit_type' => 'kg',
                'image' => 'images/productos/panSemiEspelta.jpg',
            ]
        );
    }
}