<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@aston.ac.uk',
                'password' => Hash::make('password'),
                'first_name' => 'Admin',
                'last_name' => 'User',
                'role' => 'admin',
                'created_at' => now(),
            ],
        ]);

        $faker = fake('en_GB');

        $customers = [];
        for ($i = 1; $i <= 5; $i++) { // for loop -> demo customers
            $customers[] = [
                'username' => "customer$i",
                'email' => $faker->email(),
                'password' => Hash::make('password'),
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'phone' => $faker->phoneNumber(),
                'address' => $faker->address(),
                'role' => 'customer',
                'created_at' => now(),
            ];
        }

        DB::table('users')->insert($customers);

        DB::table('categories')->insert([
            ['category_name' => 'Tabletop Games', 'description' => 'Board games and card games'],      // Category ID 1
            ['category_name' => 'Video Games', 'description' => 'Games for 8th and 9th gen consoles'], // 2
            ['category_name' => 'Accessories', 'description' => 'Gaming accessories'], // 3
            ['category_name' => 'Consoles', 'description' => 'PlayStation, Xbox, Nintendo'], // 4
        ]);


        $products = [
            [ // non tabletop
                'product_name' => 'The Legend of Zelda: Breath of the Wild',
                'description' => 'Open-world adventure for Nintendo Switch',
                'category_id' => 2,
                'price' => 49.99,
                'product_type' => 'video_games',
                'image_url' => '/images/zelda.jpg',
            ],
            [
                'product_name' => 'PlayStation 5 Controller',
                'description' => 'DualSense Wireless Controller',
                'category_id' => 3,
                'price' => 59.99,
                'product_type' => 'video_games_accessories',
                'image_url' => '/images/ps5-controller.jpg',
            ],
            [
                'product_name' => 'Xbox Series X',
                'description' => 'Next-gen Microsoft console',
                'category_id' => 4,
                'price' => 449.99,
                'product_type' => 'consoles',
                'image_url' => '/images/xbox.jpg',
            ],
            [
                'product_name' => 'Nintendo Switch 2',
                'description' => 'Nintendo\'s flagship handheld',
                'category_id' => 4,
                'price' => 395.99,
                'product_type' => 'consoles',
                'image_url' => '/images/switch.jpg',
            ],
            [
                'product_name' => 'Elden Ring',
                'description' => 'Stunning open-world soulslike for PS5 and Xbox',
                'category_id' => 2,
                'price' => 50.00,
                'product_type' => 'video_games',
                'image_url' => '/images/eldenring.jpg',
            ],
            [ // tabletop
                'product_name' => 'Call of Cthulhu - Core Rulebook',
                'description' => 'Explore cosmic horrors with rules, mythos, tools, and mysteries',
                'category_id' => 2,
                'price' => 30.00,
                'product_type' => 'tabletop_games',
                'image_url' => '/images/cthulhu.jpg',
            ],
            [
                'product_name' => 'D&D Dragons of Stormwreck Isle Starter Set',
                'description' => 'Essential rules and adventures for heroic dragon quests',
                'category_id' => 2,
                'price' => 19.99,
                'product_type' => 'tabletop_games',
                'image_url' => '/images/stormwreck.jpg',
            ],
            [
                'product_name' => 'Warhammer 40,000: Ultimate Starter Set ',
                'description' => 'Complete Warhammer 40K set with miniatures and terrain',
                'category_id' => 2,
                'price' => 113.00,
                'product_type' => 'tabletop_games',
                'image_url' => '/images/warhammer.jpg',
            ],
            [
                'product_name' => 'Magic: the Gathering - Foundations Jumpstart Booster',
                'description' => 'Quick and fun Magic: the Gathering boosters for beginners',
                'category_id' => 2,
                'price' => 8.00,
                'product_type' => 'tabletop_games',
                'image_url' => '/images/magic.jpg',
            ],
            [
                'product_name' => 'Citadel: 28.5mm Round Bases (x10)',
                'description' => 'Pack of 28.5mm bases for miniatures assembly',
                'category_id' => 2,
                'price' => 3.10,
                'product_type' => 'tabletop_accessories',
                'image_url' => '/images/citadel.jpg',
            ]
        ];

        DB::table('products')->insert($products);


        $productIDs = DB::table('products')->pluck('product_id')->toArray();
        $customerIDs = DB::table('users')->where('role', 'customer')->pluck('user_id')->toArray();

        foreach ($customerIDs as $customerId) {
            // each customer gets a couple orders
            $orderCount = rand(1, 2);

            for ($i = 0; $i < $orderCount; $i++) {
                $orderId = DB::table('orders')->insertGetId([
                    'user_id' => $customerId,
                    'total_amount' => 0,
                    'order_status' => $faker->randomElement(['pending', 'processing', 'shipped']),
                    'payment_method' => $faker->randomElement(['card', 'paypal']),
                    'tracking_number' => Str::upper(Str::random(10)),
                    'notes' => $faker->optional()->sentence(),
                    'created_at' => now(),
                ]);

                // each order gets a few items
                $itemCount = rand(1, 3);
                $total = 0;

                for ($j = 0; $j < $itemCount; $j++) {
                    $productId = $faker->randomElement($productIDs);
                    $product = DB::table('products')->where('product_id', $productId)->first();
                    $quantity = rand(1, 3);

                    DB::table('order_items')->insert([
                        'order_id' => $orderId,
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'price' => $product->price,
                        'created_at' => now(),
                    ]);

                    $total += $product->price * $quantity;
                }

                DB::table('orders')->where('order_id', $orderId)->update([
                    'total_amount' => $total,
                ]);
            }
        }

    }
}
