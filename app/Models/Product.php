<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model

{
    protected $guarded = [];

    use hasFactory ;

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
