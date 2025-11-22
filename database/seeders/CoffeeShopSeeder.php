<?php

namespace Database\Seeders;

use App\Models\CoffeeShop;
use App\Models\CoffeeShopImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CoffeeShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get users
        $admin = User::where('email', 'admin@coffeefinder.com')->first();
        $user = User::where('email', 'user@coffeefinder.com')->first();

        // Create additional users if they don't exist
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@coffeefinder.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
        }

        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'user@coffeefinder.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]);
        }

        // Create more users
        $user2 = User::firstOrCreate(
            ['email' => 'john@example.com'],
            [
                'name' => 'John Smith',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        $user3 = User::firstOrCreate(
            ['email' => 'sarah@example.com'],
            [
                'name' => 'Sarah Johnson',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        // Sample coffee shops data
        $coffeeShops = [
            [
                'user_id' => $admin->id,
                'name' => 'Starbucks Central',
                'description' => 'A cozy coffee shop in the heart of the city. We serve premium coffee and delicious pastries. Perfect for meetings or just relaxing with a good book.',
                'address' => '123 Main Street, Downtown',
                'phone' => '+1 (555) 123-4567',
                'website' => 'https://www.starbucks.com',
            ],
            [
                'user_id' => $user->id,
                'name' => 'Blue Moon Café',
                'description' => 'A charming local café known for its artisanal coffee and homemade desserts. We source our beans directly from sustainable farms.',
                'address' => '456 Oak Avenue, Midtown',
                'phone' => '+1 (555) 234-5678',
                'website' => null,
            ],
            [
                'user_id' => $user2->id,
                'name' => 'The Roastery',
                'description' => 'Specialty coffee roastery and café. We roast our beans in-house daily and offer a variety of brewing methods including pour-over, espresso, and cold brew.',
                'address' => '789 Elm Street, Uptown',
                'phone' => '+1 (555) 345-6789',
                'website' => 'https://www.theroastery.com',
            ],
            [
                'user_id' => $user3->id,
                'name' => 'Café Latte',
                'description' => 'A modern coffee shop with a minimalist design. We focus on quality coffee and excellent customer service. Free WiFi available.',
                'address' => '321 Pine Road, Riverside',
                'phone' => '+1 (555) 456-7890',
                'website' => null,
            ],
            [
                'user_id' => $admin->id,
                'name' => 'Espresso Express',
                'description' => 'Quick service coffee shop perfect for your morning commute. We serve freshly brewed coffee, espresso, and breakfast sandwiches.',
                'address' => '654 Maple Drive, Business District',
                'phone' => '+1 (555) 567-8901',
                'website' => 'https://www.espressoexpress.com',
            ],
            [
                'user_id' => $user->id,
                'name' => 'The Coffee House',
                'description' => 'A traditional coffee house with a warm, welcoming atmosphere. We serve classic coffee drinks and have a selection of board games for customers.',
                'address' => '987 Cedar Lane, Historic District',
                'phone' => '+1 (555) 678-9012',
                'website' => null,
            ],
            [
                'user_id' => $user2->id,
                'name' => 'Bean There',
                'description' => 'Eco-friendly coffee shop committed to sustainability. We use compostable cups and source fair-trade coffee beans. Great for environmentally conscious coffee lovers.',
                'address' => '147 Birch Boulevard, Green Valley',
                'phone' => '+1 (555) 789-0123',
                'website' => 'https://www.beanthere.com',
            ],
            [
                'user_id' => $user3->id,
                'name' => 'Morning Brew',
                'description' => 'Early morning coffee shop that opens at 6 AM. Perfect for early risers and commuters. We serve strong coffee and fresh pastries.',
                'address' => '258 Spruce Street, Downtown',
                'phone' => '+1 (555) 890-1234',
                'website' => null,
            ],
        ];

        // Create coffee shops
        foreach ($coffeeShops as $shopData) {
            $coffeeShop = CoffeeShop::create($shopData);

            // Don't create placeholder images - users should upload real images through the interface
            // This ensures data integrity and proper file management
        }
    }
}

