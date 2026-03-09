<?php

namespace Database\Factories;

use App\Models\HardwareItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HardwareItem>
 */
class HardwareItemFactory extends Factory
{
    protected $model = HardwareItem::class;

    public function definition(): array
    {
        $items = [
            ['name' => 'MacBook Pro 14"', 'category' => 'Laptop', 'brand' => 'Apple'],
            ['name' => 'Dell XPS 15', 'category' => 'Laptop', 'brand' => 'Dell'],
            ['name' => 'iPad Pro 12.9"', 'category' => 'Tablet', 'brand' => 'Apple'],
            ['name' => 'Samsung Galaxy Tab S9', 'category' => 'Tablet', 'brand' => 'Samsung'],
            ['name' => 'Logitech MX Keys', 'category' => 'Toetsenbord', 'brand' => 'Logitech'],
            ['name' => 'Logitech MX Master 3', 'category' => 'Muis', 'brand' => 'Logitech'],
            ['name' => 'Dell UltraSharp 27"', 'category' => 'Monitor', 'brand' => 'Dell'],
            ['name' => 'Sony WH-1000XM5', 'category' => 'Headset', 'brand' => 'Sony'],
            ['name' => 'Arduino Uno Rev3', 'category' => 'Microcontroller', 'brand' => 'Arduino'],
            ['name' => 'Raspberry Pi 5', 'category' => 'Microcontroller', 'brand' => 'Raspberry Pi'],
        ];

        $item = fake()->randomElement($items);

        return [
            'name' => $item['name'],
            'description' => fake()->sentence(),
            'category' => $item['category'],
            'brand' => $item['brand'],
            'model' => $item['name'],
            'serial_number' => fake()->unique()->bothify('SN-####-????'),
            'status' => 'available',
        ];
    }

    public function unavailable(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'unavailable',
        ]);
    }

    public function retired(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'retired',
        ]);
    }
}
