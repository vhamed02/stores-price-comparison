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
            'url'         => 'https://nuphy.com',
            'seller_id'   => Seller::first()->id,
        ] );
    }

    public function test_seller_can_attach_a_product_for_its_website_with_valid_data() {
        $productPath = 'https://nuphy.com/collections/keyboards/products/air75';
        $request = $this->post(
            route( 'seller.website.products.store', Website::first()->id ),
            [
                'product_id'   => Product::first()->id,
                'product_path' => $productPath
            ]
        );
        $websiteProducts = Website::first()->products->first();
        $this->assertNotEmpty( $websiteProducts );
        $request->assertSessionHasNoErrors();
    }

    public function test_seller_cannot_attach_a_product_to_its_website_with_inconsistent_product_domain_link() {
        $productPath = 'https://demo.nuphy.com/collections/keyboards/products/air75';
        $request = $this->post(
            route( 'seller.website.products.store', Website::first()->id ),
            [
                'product_id'   => Product::first()->id,
                'product_path' => $productPath
            ]
        );
        $websiteProducts = Website::first()->products->first();
        $this->assertEmpty( $websiteProducts );
        $request->assertSessionHasErrors('inconsistent_domain');
    }
}
