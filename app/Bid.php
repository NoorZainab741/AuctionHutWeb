<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable =['amount', 'user_id', 'auction_id', 'status'];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function auction() {
        return $this->belongsTo(Auction::class);
    }
}
