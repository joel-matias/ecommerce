<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Joel Geovanny',
            'last_name' => 'Matias Santiago',
            'document_type' => '1',
            'document_number' => '12345678',
            'phone' => '987654321',
            'email' => 'joelsantiagos000@gmail.com',
            'password' => bcrypt('joel12san'),
        ]);
        $this->call([
            FamilySedeer::class,
            OptionSeeder::class,
        ]);

        Product::factory(1500)->create();
    }
}
