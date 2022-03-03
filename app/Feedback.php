<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ['auction_id', 'user_id', 'feedback', 'rating'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function auction() {
        return $this->belongsTo(Auction::class);
    }
}
