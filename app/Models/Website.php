<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Website extends Model {
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'seller_id',
    ];

    public function seller(): BelongsTo {
        return $this->belongsTo( Seller::class );
    }

    public function products() {
        return $this
            ->belongsToMany(
                Product::class,
                'website_product',
                'website_id',
                'product_id'
            )->withPivot('prev_price', 'current_price', 'in_stock', 'product_path', 'recorded_at');
    }

}
