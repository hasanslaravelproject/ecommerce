<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'address',
        'email',
        'password',
        'profile_image',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = ['password'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
