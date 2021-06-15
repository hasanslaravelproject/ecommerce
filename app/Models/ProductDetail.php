<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductDetail extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'price',
        'color',
        'size',
        'discount_type',
        'discount',
        'description',
        'product_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'product_details';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
