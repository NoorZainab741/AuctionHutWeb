<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'icon'];

    public function auctions()
    {
        return $this->hasMany(Auction::class);
    }

}
