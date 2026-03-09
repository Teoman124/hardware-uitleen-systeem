<?php

namespace Database\Seeders;

use App\Models\HardwareItem;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Vaste gebruikers
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Extra gebruikers
        $users = User::factory(5)->create();

        // Hardware-items
        $items = HardwareItem::factory(10)->create();

        // Voorbeeldleningen in verschillende statussen
        Loan::factory()->create([
            'user_id' => $user->id,
            'hardware_item_id' => $items[0]->id,
            'status' => 'pending',
        ]);

        Loan::factory()->borrowed()->create([
            'user_id' => $user->id,
            'hardware_item_id' => $items[1]->id,
        ]);

        Loan::factory()->returned()->create([
            'user_id' => $user->id,
            'hardware_item_id' => $items[2]->id,
        ]);

        Loan::factory()->rejected()->create([
            'user_id' => $users[0]->id,
            'hardware_item_id' => $items[3]->id,
        ]);

        // Markeer uitgeleende items als unavailable
        $items[1]->update(['status' => 'unavailable']);
    }
}
