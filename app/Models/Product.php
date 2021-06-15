<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'image',
        'status',
        'slug',
        'shop_id',
        'category_id',
        'brand_id',
        'created_at',
    ];

    protected $searchableFields = ['*'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function productDetails()
    {
        return $this->hasOne(ProductDetail::class);
    }
}
