<?php

namespace App\Http\Controllers\API;

use App\Auction;
use App\Bid;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BidController extends Controller
{

    public function getBidsForAuction(Request $request)
    {
        $data = Bid::where(['auction_id' => $request->auction_id])->get()->all();
        if($data)
        {
            return response()->json(['bids' => $data]);
        }
        else
        {
            return response()->json(['bids' => []]);
        }
    }

    public function getUserBids(Request $request)
    {
        $data = Bid::where(['user_id' => $request->user_id])->load('auction')->get()->all();
//        $data->load('auction');

        if($data)
        {
            return response()->json(['bids' => $data]);
        }
        else
        {
            return response()->json(['bids' => []]);
        }
    }

    public function createBid(Request $request)
    {
        $bid = Bid::create($request->all());

        if($bid)
        {
            return response()->json(['bid' => "yes"]);
        }
        else
        {
            return response()->json(['bid' => "no"]);
        }
    }

    public function updateBid(Request $request)
    {
        $bid = Bid::where('id', $request->id)->first();
        $bid->update($request->all());

        if($bid)
        {
            return response()->json(['bid' => "yes"]);
        }
        else
        {
            return response()->json(['bid' => "no"]);
        }
    }

    public function acceptBid(Request $request)
    {
        $bid = Bid::where('id', $request->id)->first();
        $bid->update($request->all());
        $auction = Auction::where('id', $request->auction_id)->first();
        $auction->update(['status' => 'Accepted']);

        if($bid)
        {
            return response()->json(['bid' => "yes"]);
        }
        else
        {
            return response()->json(['bid' => "no"]);
        }
    }

    public function deleteBid(Request $request)
    {
        $bid = Bid::where('id', $request->id)->first();
        $bid->delete();

        if($bid)
        {
            return response()->json(['bid' => "deleted"]);
        }
        else
        {
            return response()->json(['bid' => "not deleted"]);
        }
    }


    public function __construct()
    {
        $this->middleware('auth:api_user');
    }
}
