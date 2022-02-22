<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Product::create([
            'name' => 'Udon',
            'image' => 'Udon',
            'deskripsi' => 'zazazaazazazazazazazaaazazazazazazaazazazz',
            'qty' => 1,
            'harga' => 35000,
        ]);
        Product::create([
            'name' => 'Ebi Furai',
            'image' => 'Ebi',
            'deskripsi' => 'zazazaazazazazazazazaaazazazazazazaazazazz',
            'qty' => 1,
            'harga' => 25000,
        ]);
        Product::create([
            'name' => 'Sushi',
            'image' => 'Sushi',
            'deskripsi' => 'zazazaazazazazazazazaaazazazazazazaazazazz',
            'qty' => 1,
            'harga' => 50000,
        ]);
    }
}
