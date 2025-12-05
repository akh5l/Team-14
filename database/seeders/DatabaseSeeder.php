<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'username'   => 'admin',
                'email'      => 'admin@aston.ac.uk',
                'password'   => Hash::make('password'),
                'first_name' => 'Admin',
                'last_name'  => 'User',
                'role'       => 'admin',
                'created_at' => now(),
            ],
        ]);

        $faker = Faker::create('en_GB');

        $customers = [];
        for ($i = 1; $i <= 5; $i++) { // for loop -> demo customers
            $customers[] = [
                'username'   => "customer$i",
                'email'      => $faker->email(),
                'password'   => Hash::make('password'),
                'first_name' => $faker->firstName(),
                'last_name'  => $faker->lastName(),
                'phone'      => $faker->phoneNumber(),
                'address'    => $faker->address(),
                'role'       => 'customer',
                'created_at' => now(),
            ];
        }

        DB::table('users')->insert($customers);

        DB::table('categories')->insert([
            ['category_name' => 'Tabletop Games', 'description' => 'Board games and card games'],                   // Category ID 1
            ['category_name' => 'Video Games', 'description' => 'Games for 8th and 9th gen consoles'],              // 2
            ['category_name' => 'Tabletop Game Accessories', 'description' => 'Accessories for tabletop gameplay'], // 3
            ['category_name' => 'Video Game Accessories', 'description' => 'Video game accessories'],               // 4
            ['category_name' => 'Consoles', 'description' => 'PlayStation, Xbox, Nintendo'],                        // 5
        ]);

        $products = [
            [ // video games
                'product_name'         => 'God of War: Ragnarök',
                'description'          => 'Epic Norse action-adventure with gods, monsters, and emotional storytelling',
                'description_detailed' => 'A narrative-focused action game following Kratos and Atreus through the Norse realms. The story blends emotional character moments with cinematic combat, exploration, environmental puzzles, and progression systems across visually detailed mythological landscapes.',
                'category_id'          => 2,
                'price'                => 34.99,
                'image_url'            => 'images/products/god-of-war-ragnarok.jpg',
            ],
            [
                'product_name'         => 'Red Dead Redemption 2',
                'description'          => 'An immersive Wild West story with action and exploration.',
                'description_detailed' => 'A Western open-world narrative game featuring realistic environments, long story missions, world events, and deep characters. Players follow Arthur Morgan as the Van der Linde gang struggles against civilisation and internal conflict in a changing America.',
                'category_id'          => 2,
                'price'                => 19.99,
                'image_url'            => 'images/products/red-dead.png',
            ],
            [
                'product_name'         => 'Cyberpunk 2077',
                'description'          => 'An open‑world cyberpunk adventure with deep storytelling.',
                'description_detailed' => 'A futuristic open-world RPG set in Night City, featuring branching storylines, character builds, hacking systems, and combat. Players shape V’s journey through narrative choices, upgrades, and dynamic missions in a world filled with gangs, corporations, and cybernetic enhancements.',
                'category_id'          => 2,
                'price'                => 20.99,
                'image_url'            => 'images/products/cyberpunk.png',
            ],
            [
                'product_name'         => 'The Legend of Zelda: Breath of the Wild',
                'description'          => 'Open-world adventure for Nintendo Switch',
                'description_detailed' => 'An open-world adventure following Link as he awakens in a vast kingdom threatened by Calamity Ganon. The story combines exploration, environmental puzzles, dynamic combat, and progression systems across a beautifully detailed and interactive landscape filled with secrets and challenges.',
                'category_id'          => 2,
                'price'                => 49.99,
                'image_url'            => 'images/products/legend-of-zelda-botw.png',
            ],
            [
                'product_name'         => 'Elden Ring',
                'description'          => 'Stunning open-world soulslike for PS5 and Xbox',
                'description_detailed' => 'A dark fantasy action RPG guiding the Tarnished through the Lands Between in search of the Elden Ring. The game blends intense combat, intricate world exploration, strategic progression, and deep lore across sprawling, hauntingly detailed environments filled with formidable enemies and hidden mysteries.',
                'category_id'          => 2,
                'price'                => 50.00,
                'image_url'            => 'images/products/elden-ring.png',
            ],

            [ // video game accessories
                'product_name'         => 'PlayStation Pulse 3D Headset',
                'description'          => 'Wireless gaming headset with immersive 3D audio for PS5.',
                'description_detailed' => 'A wireless headset built for PS5’s Tempest 3D AudioTech, offering immersive directional sound, dual noise-cancelling microphones, USB-C charging, and a lightweight design ideal for gaming, party chat, and long gaming sessions.',
                'category_id'          => 4,
                'price'                => 84.99,
                'image_url'            => 'images/products/3d-pulse-headset.png',
            ],
            [
                'product_name'         => 'Xbox Wireless Headset',
                'description'          => 'Comfortable wireless headset with spatial sound and built‑in mic.',
                'description_detailed' => 'A premium wireless headset for Xbox Series X/S with spatial audio support, rotating ear-cup dials, noise-isolating microphone, and Bluetooth connectivity. Delivers clear in-game sound and flexible pairing for console and mobile.',
                'category_id'          => 4,
                'price'                => 89.99,
                'image_url'            => 'images/products/xbox-wireless-headset.png',
            ],
            [
                'product_name'         => 'Nintendo Switch Joy-Con Wheel Pair',
                'description'          => 'Steering‑wheel grips for motion‑controlled racing games.',
                'description_detailed' => 'A lightweight, easy-to-use steering-wheel accessory designed for Joy-Cons. Ideal for Mario Kart and other racing games, it provides better grip, more accurate motion controls, and a more immersive driving experience for both casual and competitive players.',
                'category_id'          => 4,
                'price'                => 17.99,
                'image_url'            => 'images/products/nintendo-joy-con.png',
            ],
            [
                'product_name'         => 'Nintendo Switch 2 Pro Controller',
                'description'          => 'Premium wireless controller for precise and comfortable gameplay.',
                'description_detailed' => 'A premium wireless controller for Switch 2 featuring HD Rumble 2, motion controls, a 3.5 mm audio jack for headsets, and remappable rear buttons. Offers comfortable ergonomics and strong battery life, ideal for long gaming sessions on console.',
                'category_id'          => 4,
                'price'                => 64.99,
                'image_url'            => 'images/products/nintendo-switch-2-pro-controller.png',
            ],

            [
                'product_name'         => 'PlayStation 5 Controller',
                'description'          => 'DualSense Wireless Controller',
                'description_detailed' => 'A premium wireless controller for PS5 featuring haptic feedback, adaptive triggers, a built-in microphone, and a 3.5 mm audio jack for headsets. Offers comfortable ergonomics, responsive buttons, and long battery life, ideal for extended gaming sessions on console.',
                'category_id'          => 4,
                'price'                => 59.99,
                'image_url'            => 'images/products/ps5-controller.png',
            ],

            [ // consoles
                'product_name'         => 'Xbox Series X',
                'description'          => 'Next-gen Microsoft console',
                'description_detailed' => 'A next-generation gaming console offering 4K resolution, high frame rates, and fast load times with the Xbox Velocity Architecture. Features a vast library of games, backwards compatibility, and online multiplayer for immersive console gaming.',
                'category_id'          => 5,
                'price'                => 449.99,
                'image_url'            => 'images/products/xbox.png',
            ],
            [
                'product_name'         => 'Nintendo Switch 2',
                'description'          => 'Nintendo\'s flagship handheld',
                'description_detailed' => 'A versatile hybrid console for home and handheld play featuring improved graphics, longer battery life, and a broad library of first-party and third-party games. Supports motion controls, multiplayer, and portable gaming experiences anywhere.',
                'category_id'          => 5,
                'price'                => 395.99,
                'image_url'            => 'images/products/switch2.png',
            ],
            [
                'product_name'         => 'Playstation 5',
                'description'          => 'Next‑gen PlayStation console built for speed, power, and immersion.',
                'description_detailed' => 'A ninth-generation console by Sony delivering 4K graphics, fast SSD load times, and a wide library of exclusive games. It supports ray tracing, high frame rates, and backwards compatibility, ideal for immersive next-gen gaming and console exclusives.',
                'category_id'          => 5,
                'price'                => 349.99,
                'image_url'            => 'images/products/ps5.jpg',
            ],
            [
                'product_name'         => 'Xbox Series S',
                'description'          => 'Affordable next‑gen console built for fast, high‑quality digital gaming.',
                'description_detailed' => 'A budget-friendly, all-digital Xbox console that delivers next-gen gaming at lower cost. Great for 1080p or 1440p gaming, digital-only libraries, and smaller living spaces, an affordable entry point to modern console gaming.',
                'category_id'          => 5,
                'price'                => 329.99,
                'image_url'            => 'images/products/xbox-series-s.png',
            ],
            [
                'product_name'         => 'Playstation 5 Pro',
                'description'          => 'Premium next‑gen console for smoother gameplay and sharper visuals.',
                'description_detailed' => 'A premium next-gen console offering a 2 TB SSD, upgraded GPU and ray-tracing, AI-powered upscaling and high-frame-rate support for “Pro-Enhanced” games. Ideal for players who want top-tier graphics, performance, and future-proof console gaming.',
                'category_id'          => 5,
                'price'                => 699.99,
                'image_url'            => 'images/products/ps5-pro.png',
            ],

            [ // tabletop
                'product_name'         => 'Call of Cthulhu - Core Rulebook', 'description_detailed' => '',
                'description'          => 'Explore cosmic horrors with rules, mythos, tools, and mysteries',
                'description_detailed' => 'This essential guide provides investigators (players) with detailed rules, mythos knowledge, and tools to explore a world filled with cosmic terror, insanity, and ancient secrets. Dive into a rich horror experience inspired by H.P. Lovecraft\'s works and unravel mysteries that threaten sanity and existence itself.',
                'category_id'          => 1,
                'price'                => 30.00,
                'image_url'            => 'images/products/cthulhu.png',
            ],
            [
                'product_name'         => 'D&D Dragons of Stormwreck Isle Starter Set',
                'description'          => 'Essential rules and adventures for heroic dragon quests',
                'description_detailed' => 'This box contains the essential rules of the game plus everything you need to play heroic characters caught up in an ancient war among dragons as they explore the secrets of Stormwreck Isle. For 2-6 players.',
                'category_id'          => 1,
                'price'                => 19.99,
                'image_url'            => 'images/products/d&d.png',
            ],
            [
                'product_name'         => 'Warhammer 40,000: Ultimate Starter Set ',
                'description'          => 'Complete Warhammer 40K set with miniatures and terrain',
                'description_detailed' => 'A boxed Warhammer 40,000 set featuring a 72-page Ultimate Starter Set Handbook with tutorials and missions, a Core Rules Booklet, 12 Space Marines, 32 Tyranids, 9 modular terrain pieces, 2 reference sheets, 2 double-sided gaming boards, 2 range rulers, and 10 dice. Miniatures are unpainted and require assembly for full gameplay.',
                'category_id'          => 1,
                'price'                => 113.00,
                'image_url'            => 'images/products/warhammer.png',
            ],
            [
                'product_name'         => 'Magic: The Gathering - Foundations Jumpstart Booster',
                'description'          => 'Quick and fun Magic: The Gathering boosters for beginners',
                'description_detailed' => 'Jumpstart Boosters are quick, fun ways to play Magic: The Gathering. Just grab two boosters, shuffle, and you\'re ready! Each contains 20 cards, including Lands, at least 1 Rare or Mythic Rare, and 1 anime-inspired card. They feature over 46 themes like Goblins, Dinosaurs, and Ninjas for creative mashups. Perfect for fast games and teaching new players. Contents: 2 Boosters with 20 cards each.',
                'category_id'          => 1,
                'price'                => 8.00,
                'image_url'            => 'images/products/magic.png',
            ],
            [
                'product_name'         => 'Gwent Card Game',
                'description'          => 'A strategic fantasy card game set in The Witcher universe.',
                'description_detailed' => 'Step into the action with The Witcher Gwent: The Legendary Card Game, a vibrant celebration of a decade of strategic gameplay. This premium boxed set brings the thrilling experience of Gwent from the screen to your tabletop, featuring five iconic factions like the stealthy Scoia’tael and the fearsome Monsters. Each game session is filled with high-stakes choices, power plays, and cunning strategy that will have players on the edge of their seats as they outsmart one another.',
                'category_id'          => 1,
                'price'                => 44.99,
                'image_url'            => 'images/products/gwent.jpg',
            ],

            [ // tabletop accessories
                'product_name'         => 'Citadel: 28.5mm Round Bases (x10)',
                'description'          => 'Pack of 28.5mm bases for miniatures assembly',
                'description_detailed' => 'Need some extra bases or lost those that came with your miniatures? Don\'t fret! This 10 pack of 28.5 miniature bases are perfect to help to get you back on track with building, priming and painting your miniatures',
                'category_id'          => 3,
                'price'                => 3.10,
                'image_url'            => 'images/products/citadel.png',
            ],
            [
                'product_name'         => 'TT Combat Green Dice (Gaming Dice)',
                'description'          => 'High‑quality polyhedral dice set ideal for D&D and tabletop combat games.',
                'description_detailed' => 'TT Combat Green Dice are high-quality gaming dice featuring a vibrant green color, perfect for tabletop RPGs, board games, and miniature wargaming. Crafted for durability and precision, these dice enhance your gaming experience with their striking appearance and reliable roll results.',
                'category_id'          => 3,
                'price'                => 3.10,
                'image_url'            => 'images/products/dice-20.jpg',
            ],
            [
                'product_name'         => 'TT Green Combat Dice',
                'description'          => 'Durable six-sided green dice set for tabletop RPGs and wargames.',
                'description_detailed' => 'TT Combat Green Dice are high-quality gaming dice featuring a vibrant green color, perfect for tabletop RPGs, board games, and miniature wargaming. Crafted for durability and precision, these dice enhance your gaming experience with their striking appearance and reliable roll results.',
                'category_id'          => 3,
                'price'                => 3.10,
                'image_url'            => 'images/products/dice-6.jpg',
            ],
            [
                'product_name'         => 'Goblin Mystery Resin Dice Set',
                'description'          => 'Random colour D&D dice set made from high‑quality resin.',
                'description_detailed' => 'Receive one complete 7-piece polyhedral dice set (d4, d6, d8, d10, d%, d12, d20) in a randomly selected design. With over 200 unique styles available, every mystery set is a thrilling surprise!',
                'category_id'          => 3,
                'price'                => 10.00,
                'image_url'            => 'images/products/dice-goblin.webp',
            ],
            [
                'product_name'         => 'Dungeons & Dragons: Figurines of Adorable Plush Mind Flayer Gamer Pouch',
                'description'          => 'Cute zip‑up accessory pouch inspired by the iconic Mind Flayer monster.',
                'description_detailed' => 'This is a plush D&D-themed gamer pouch designed to hold dice, coins, or small gaming accessories. It features a zippered inner compartment, a carabiner hook for easy attachment, and is made of soft plush material. Measuring about 6 x 4 x 3 inches, it\'s an officially licensed accessory perfect for RPG fans and dice enthusiasts. (Dice not included)',
                'category_id'          => 3,
                'price'                => 45.00,
                'image_url'            => 'images/products/dnd-pouch.jpg',
            ],
        ];

        DB::table('products')->insert($products);

        $productIDs  = DB::table('products')->pluck('product_id')->toArray();
        $customerIDs = DB::table('users')->where('role', 'customer')->pluck('user_id')->toArray();

        foreach ($customerIDs as $customerId) {
            // each customer gets a couple orders
            $orderCount = rand(1, 2);

            for ($i = 0; $i < $orderCount; $i++) {
                $orderId = DB::table('orders')->insertGetId([
                    'user_id'         => $customerId,
                    'total_amount'    => 0,
                    'order_status'    => $faker->randomElement(['pending', 'processing', 'shipped']),
                    'payment_method'  => $faker->randomElement(['card', 'paypal']),
                    'tracking_number' => Str::upper(Str::random(10)),
                    'notes'           => $faker->optional()->sentence(),
                    'created_at'      => now(),
                ]);

                // each order gets a few items
                $itemCount = rand(1, 3);
                $total     = 0;

                for ($j = 0; $j < $itemCount; $j++) {
                    $productId = $faker->randomElement($productIDs);
                    $product   = DB::table('products')->where('product_id', $productId)->first();
                    $quantity  = rand(1, 3);

                    DB::table('order_items')->insert([
                        'order_id'   => $orderId,
                        'product_id' => $productId,
                        'quantity'   => $quantity,
                        'price'      => $product->price,
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
