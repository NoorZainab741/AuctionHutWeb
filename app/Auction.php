<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = ['user_id', 'product_title', 'description','starting_price', 'time', 'status', 'images','category_id','starting_price'];

    protected $casts = [
        'images' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
