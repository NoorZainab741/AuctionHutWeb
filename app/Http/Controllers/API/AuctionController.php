<?php

namespace App\Http\Controllers\API;

use App\Auction;
use App\Bid;
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

    public function getAuctionsByCategories(Request $request)
    {
        $data = Auction::where(['category_id' => $request->category_id])->get()->all();
        if($data)
        {
            return response()->json(['auctions' => $data]);
        }
        else
        {
            return response()->json(['auctions' => []]);
        }
    }

    public function getAuctionDetails(Request $request)
    {
        $data = Auction::where(['id' => $request->id])->get()->all();
        if($data)
        {
            return response()->json(['auction' => $data]);
        }
        else
        {
            return response()->json(['auction' => []]);
        }
    }

    public function createAuction(Request $request)
    {
        $imagePath = array();
        $userID = auth()->user()->id;
        $auction = Auction::create($request->except('images'));
        if ($request->images)
        {
            foreach ($request->file('images') as $image){
                $imagePath[] = $image->store('/auctions/'.$auction->id.'/images', 'public');
            }
        }
        $auction->update([
            'images' => $imagePath
        ]);

//        $data = Auction::where(['category_id' => $request->category_id])->get()->all();
        if($auction)
        {
            return response()->json(['auction' => "yes"]);
        }
        else
        {
            return response()->json(['auction' => "no"]);
        }
    }

    public function updateAuction(Request $request)
    {
        $auction = Auction::where('id', $request->id)->first();
        $auction->update($request->except('images','_token','_method'));
        if ($request->images)
        {
            foreach ($request->file('images') as $image){
                $imagePath[] = $image->store('/auctions/'.$auction->id.'/images', 'public');
            }
        }
        $auction->update([
            'images' => $imagePath
        ]);

        if($auction)
        {
            return response()->json(['auction' => "yes"]);
        }
        else
        {
            return response()->json(['auction' => "no"]);
        }
    }

    public function deleteAuction(Request $request)
    {
        $auction = Auction::where('id', $request->id)->first();
        $auction->delete();
        $bids = Bid::where('auction_id', $request->id)-> get()->all();
        $bids->delete();
        if($auction)
        {
            return response()->json(['auction' => "deleted"]);
        }
        else
        {
            return response()->json(['auction' => "not deleted"]);
        }
    }

    public function __construct()
    {
        $this->middleware('auth:api_user');
    }
}
