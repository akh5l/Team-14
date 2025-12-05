<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;

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

        $faker = Faker::create('en_GB');

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
            ['category_name' => 'Tabletop Game Accessories', 'description' => 'Accessories for tabletop gameplay'], // 3
            ['category_name' => 'Video Game Accessories', 'description' => 'Video game accessories'], // 4
            ['category_name' => 'Consoles', 'description' => 'PlayStation, Xbox, Nintendo'], // 5
        ]);


        $products = [
            [ // video games
                'product_name' => 'God of War: Ragnarök',
                'description' => 'Epic Norse action-adventure with gods, monsters, and emotional storytelling',
                'category_id' => 2,
                'price' => 34.99,
                'image_url' => 'images/products/god-of-war-ragnarok.png',
            ],
            [ 
                'product_name' => 'Red Dead Redemption 2',
                'description' => 'An immersive Wild West story with action and exploration.',
                'category_id' => 2,
                'price' => 19.99,
                'image_url' => 'images/products/red-dead.png',
            ],
            [ 
                'product_name' => 'Cyberpunk 2077',
                'description' => 'An open‑world cyberpunk adventure with deep storytelling.',
                'category_id' => 2,
                'price' => 20.99,
                'image_url' => 'images/products/cyberpunk.png',
            ],
            [ 
                'product_name' => 'The Legend of Zelda: Breath of the Wild',
                'description' => 'Open-world adventure for Nintendo Switch',
                'category_id' => 2,
                'price' => 49.99,
                'image_url' => 'images/products/legend-of-zelda-botw.png',
            ],
            [
                'product_name' => 'Elden Ring',
                'description' => 'Stunning open-world soulslike for PS5 and Xbox',
                'category_id' => 2,
                'price' => 50.00,
                'image_url' => 'images/products/elden-ring.png',
            ],

            [ // video game accessories
                'product_name' => 'PlayStation Pulse 3D Headset',
                'description' => 'Wireless gaming headset with immersive 3D audio for PS5.',
                'category_id' => 4,
                'price' => 84.99,
                'image_url' => 'images/products/3d-pulse-headset.png',
            ],
            [ 
                'product_name' => 'Xbox Wireless Headset',
                'description' => 'Comfortable wireless headset with spatial sound and built‑in mic.',
                'category_id' => 4,
                'price' => 89.99,
                'image_url' => 'images/products/xbox-wireless-headset.png',
            ],
            [ 
                'product_name' => 'Nintendo Switch Joy-Con Wheel Pair',
                'description' => 'Steering‑wheel grips for motion‑controlled racing games.',
                'category_id' => 4,
                'price' => 17.99,
                'image_url' => 'images/products/nintendo-joy-con.png',
            ],
            [ 
                'product_name' => 'Nintendo Switch 2 Pro Controller',
                'description' => 'Premium wireless controller for precise and comfortable gameplay.',
                'category_id' => 4,
                'price' => 64.99,
                'image_url' => 'images/products/nintendo-switch-2-pro-controller.png',
            ],

            [ 
                'product_name' => 'PlayStation 5 Controller',
                'description' => 'DualSense Wireless Controller',
                'category_id' => 4,
                'price' => 59.99,
                'image_url' => 'images/products/ps5-controller.png',
            ],

            [ // consoles
                'product_name' => 'Xbox Series X',
                'description' => 'Next-gen Microsoft console',
                'category_id' => 5,
                'price' => 449.99,
                'image_url' => 'images/products/xbox.png',
            ],
            [
                'product_name' => 'Nintendo Switch 2',
                'description' => 'Nintendo\'s flagship handheld',
                'category_id' => 5,
                'price' => 395.99,
                'image_url' => 'images/products/switch2.png',
            ],
            [
                'product_name' => 'Playstation 5',
                'description' => 'Next‑gen PlayStation console built for speed, power, and immersion.',
                'category_id' => 5,
                'price' => 349.99,
                'image_url' => 'images/products/ps5.jpg',
            ],
            [
                'product_name' => 'Xbox Series S',
                'description' => 'Affordable next‑gen console built for fast, high‑quality digital gaming.',
                'category_id' => 5,
                'price' => 329.99,
                'image_url' => 'images/products/xbox-series-s.png',
            ],
            [
                'product_name' => 'Playstation 5 Pro',
                'description' => 'Premium next‑gen console for smoother gameplay and sharper visuals.',
                'category_id' => 5,
                'price' => 699.99,
                'image_url' => 'images/products/ps5-pro.png',
            ],       
            
            [ // tabletop
                'product_name' => 'Call of Cthulhu - Core Rulebook',
                'description' => 'Explore cosmic horrors with rules, mythos, tools, and mysteries',
                'category_id' => 1,
                'price' => 30.00,
                'image_url' => 'images/products/cthulhu.png',
            ],
            [
                'product_name' => 'D&D Dragons of Stormwreck Isle Starter Set',
                'description' => 'Essential rules and adventures for heroic dragon quests',
                'category_id' => 1,
                'price' => 19.99,
                'image_url' => 'images/products/d&d.png',
            ],
            [
                'product_name' => 'Warhammer 40,000: Ultimate Starter Set ',
                'description' => 'Complete Warhammer 40K set with miniatures and terrain',
                'category_id' => 1,
                'price' => 113.00,
                'image_url' => 'images/products/warhammer.png',
            ],
            [
                'product_name' => 'Magic: The Gathering - Foundations Jumpstart Booster',
                'description' => 'Quick and fun Magic: The Gathering boosters for beginners',
                'category_id' => 1,
                'price' => 8.00,
                'image_url' => 'images/products/magic.png',
            ],
            [
                'product_name' => 'Gwent Card Game',
                'description' => 'A strategic fantasy card game set in The Witcher universe.',
                'category_id' => 1,
                'price' => 44.99,
                'image_url' => 'images/products/gwent.jpg',
            ],

            [ // tabletop accessories
                'product_name' => 'Citadel: 28.5mm Round Bases (x10)',
                'description' => 'Pack of 28.5mm bases for miniatures assembly',
                'category_id' => 3,
                'price' => 3.10,
                'image_url' => 'images/products/citadel.png',
            ],
            [ 
                'product_name' => 'TT Combat Green Dice (Gaming Dice)',
                'description' => 'High‑quality polyhedral dice set ideal for D&D and tabletop combat games.',
                'category_id' => 3,
                'price' => 3.10,
                'image_url' => 'images/products/dice-20.jpg',
            ],
            [ 
                'product_name' => 'TT Green Combat Dice',
                'description' => 'Durable six-sided green dice set for tabletop RPGs and wargames.',
                'category_id' => 3,
                'price' => 3.10,
                'image_url' => 'images/products/dice-6.jpg',
            ],
            [ 
                'product_name' => 'Goblin Mystery Resin Dice Set',
                'description' => 'Random colour D&D dice set made from high‑quality resin.',
                'category_id' => 3,
                'price' => 10.00,
                'image_url' => 'images/products/dice-goblin.webp',
            ],
            [ 
                'product_name' => 'Dungeons & Dragons: Figurines of Adorable Plush Mind Flayer Gamer Pouch',
                'description' => 'Cute zip‑up accessory pouch inspired by the iconic Mind Flayer monster.',
                'category_id' => 3,
                'price' => 45.00,
                'image_url' => 'images/products/dnd-pouch.jpg',
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
