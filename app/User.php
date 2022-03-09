<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Intervention\Image\Image;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password','gender','role','phone','image', 'status','fcm_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function getImagePath($size = 'sm')
    {
        $sizes = [
            'lg' => '200x200',
            'sm' => '80x80',
        ];
        if ($this->image && file_exists('storage/' . $this->image))
            return asset('storage/images/'.auth()->user()->role.'/' . $this->id . '/' . $sizes[$size] . '.jpg');
        else
            return asset('assets/images/user/user.png');
    }

    public function updateImage()
    {
        if (request()->hasFile('image') && request()->file('image')->isValid()) {
            $dir = public_path('storage/images/'.auth()->user()->role.'/' . $this->id);
            if (!file_exists($dir)) mkdir($dir, 0777, true);

            $image = \Intervention\Image\Facades\Image::make(request()->file('image'));
            $image->fit(200, 200)->save($dir . '/200x200.jpg');
            $image->fit(80, 80)->save($dir . '/80x80.jpg');
            $this->update(['image' => "/images/".auth()->user()->role.'/'.$this->id."/80x80.jpg"]);
        }
    }

    public function auctions() {
        return $this->hasMany(Auction::class);
    }

    public function bids() {
        return $this->hasMany(Bid::class);
    }

    public function feedbacks() {
        return $this->hasMany(Feedback::class);
    }
}
