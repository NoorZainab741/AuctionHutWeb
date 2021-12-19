<?php

namespace App\Http\Controllers\API;

use App\Auction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuctionController extends Controller
{

    public function getAllAuctions(Request $request)
    {
        $data = Auction::get()->all();
        if($data)
        {
            return response()->json(['auctions' => $data]);
        }
        else
        {
            return response()->json(['auctions' => []]);
        }
    }

    public function __construct()
    {
        $this->middleware('auth:api_user');
    }
}
