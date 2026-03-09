<?php

namespace Database\Factories;

use App\Models\HardwareItem;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'hardware_item_id' => HardwareItem::factory(),
            'status' => 'pending',
            'requested_at' => now(),
        ];
    }

    public function approved(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'approved',
            'approved_at' => now(),
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejection_reason' => fake()->sentence(),
        ]);
    }

    public function borrowed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'borrowed',
            'approved_at' => now()->subDays(2),
            'borrowed_at' => now()->subDay(),
            'expected_return_date' => now()->addWeeks(2),
        ]);
    }

    public function returned(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'returned',
            'approved_at' => now()->subWeeks(3),
            'borrowed_at' => now()->subWeeks(3),
            'expected_return_date' => now()->subWeek(),
            'returned_at' => now()->subDays(2),
        ]);
    }
}
