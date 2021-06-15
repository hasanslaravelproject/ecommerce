<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['price', 'quantity', 'order_id', 'product_id'];

    protected $searchableFields = ['*'];

    protected $table = 'order_details';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
