<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Seller;
use App\Models\Website;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WebsiteProductsTest extends TestCase {
    use DatabaseTransactions;

    protected function setUp(): void {
        parent::setUp();
        Seller::factory()->create();
        Product::factory()->create();
        Website::create( [
            'title'       => 'sample',
            'description' => 'lorem ipsum',
            'url'         => 'https://nuphy.com/collections/keyboards/products/air75',
            'seller_id'   => Seller::first()->id,
        ] );
    }

    public function test_seller_can_attach_a_product_for_its_website_with_valid_data() {
        $productPath = 'https://site.com/product/macbook-pro';
        $this->post(
            route( 'seller.website.products.store', Website::first()->id ),
            [
                'product_id'   => Product::first()->id,
                'product_path' => $productPath
            ]
        );
        $websiteProducts = Website::first()->products->first();
        $this->assertNotNull( $websiteProducts );
        $this->assertEquals( $productPath, $websiteProducts->pivot->product_path );
    }
}
