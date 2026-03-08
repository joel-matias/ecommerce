<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku' => $this->faker->unique()->numberBetween(100000, 999999),
            'name' => $this->faker->sentence(),
            'description' => $this->faker->text(200),
            'image_path' => $this->downloadProductImagePath(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'sub_category_id' => $this->faker->numberBetween(1, 632),
        ];
    }

    private function downloadProductImagePath(): string
    {
        $relativePath = 'products/'.Str::uuid().'.jpg';
        $sources = [
            'https://picsum.photos/640/480',
            'https://loremflickr.com/640/480/product',
        ];

        foreach ($sources as $url) {
            try {
                $response = Http::timeout(12)->accept('image/*')->get($url);

                if ($response->successful() && str_starts_with($response->header('Content-Type', ''), 'image/')) {
                    Storage::disk('public')->put($relativePath, $response->body());

                    return $relativePath;
                }
            } catch (\Throwable $e) {
                // Try next source.
            }
        }

        Storage::disk('public')->put(
            $relativePath,
            file_get_contents(public_path('img/no_image.jpg'))
        );

        return $relativePath;
    }
}
