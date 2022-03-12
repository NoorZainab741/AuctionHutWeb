<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = [
        'user_id',
        'product_title',
        'description',
        'starting_price',
        'time',
        'status',
        'images',
        'category_id',
        'starting_price',
        'ending_price',
        'endAt',
        'payment_method',
        'bid_winner'];

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

    public function bids() {
        return $this->hasMany(Bid::class);
    }

    public function feedback() {
        return $this->hasOne(Feedback::class);
    }
}
