<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'category_id',
        'stock',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')->withPivot('quantity', 'price');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function trending()
    {
        return $this->hasOne(TrendingProduct::class);
    }
}
