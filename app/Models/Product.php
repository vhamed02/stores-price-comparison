<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model {
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail'
    ];

    public function websites(): BelongsToMany {
        return $this->belongsToMany(
            Website::class,
            'website_product',
            'product_id',
            'website_id'
        )->withPivot('prev_price', 'current_price', 'status', 'product_path', 'recorded_at');
    }
}
