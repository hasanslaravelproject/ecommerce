<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['total', 'discount', 'status'];
    protected $dates = ['expire_date'];

    protected $searchableFields = ['*'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
