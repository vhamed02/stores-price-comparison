<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Seller;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Website;
use Carbon\Carbon;
use Database\Factories\WebsiteProductFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Seller::factory(10)->create();
        Website::factory(10)->create();
        Product::factory(10)->create();

        foreach(range(1, 100) as $i) {
            $prevPrice = $this->decimalRand(5, 750, 0.5);
            DB::table('website_product')->insertOrIgnore([
                'website_id' => rand(1, 10),
                'product_id' => rand(1, 10),
                'prev_price' => $prevPrice,
                'current_price' => $prevPrice - $this->decimalRand(0.5, $prevPrice / 2, 0.5),
                'in_stock' => rand(0, 1),
                'product_path' => '/product/' . fake()->slug(),
                'recorded_at' => Carbon::now()->subDays(rand(0, 30))->subSeconds(rand(1, 10000)),
            ]);
        }
    }

    private function decimalRand($iMin, $iMax, $fSteps = 0.5)
    {
        $a = range($iMin, $iMax, $fSteps);

        return $a[mt_rand(0, count($a)-1)];
    }
}
