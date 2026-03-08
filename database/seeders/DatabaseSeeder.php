<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');

        User::factory()->create([
            'name' => 'Joel Geovanny',
            'last_name' => 'Matias Santiago',
            'document_type' => '1',
            'document_number' => '12345678',
            'phone' => '987654321',
            'email' => 'joelsantiagos000@gmail.com',
            'password' => bcrypt('joel12san'),
        ]);

        User::factory(20)->create();

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            FamilySedeer::class,
            OptionSeeder::class,
        ]);

        Product::factory(15)->create();
    }
}