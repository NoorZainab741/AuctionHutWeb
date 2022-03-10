<?php

namespace App\Http\Controllers\API;

use App\Auction;
use App\Bid;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
        $carbon_date = Carbon::parse($request->createdAt);

        $carbon_date->addHours($request->time);
        $auction->update(['endAt'=>$carbon_date]);

//        dd($carbon_date->toArray());

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
        $imagePath = array();
        $auction = Auction::where('id', $request->id)->first();
        $auction->update($request->except('images','_token','_method'));
        if ($request->images)
        {
            foreach ($request->file('images') as $image){
                $imagePath[] = $image->store('/auctions/'.$auction->id.'/images', 'public');
            }
            $auction->update([
                'images' => $imagePath
            ]);
        }
        $carbon_date = Carbon::parse($request->createdAt);

        $carbon_date->addHours($request->time);
        $auction->update(['endAt'=>$carbon_date]);

        if($auction)
        {
            return response()->json(['auction' => "yes"]);
        }
        else
        {
            return response()->json(['auction' => "no"]);
        }
    }

    public function completeAuction(Request $request)
    {
        $auction = Auction::where('id', $request->auction_id)->first();
        $auction->update($request->all());
        $bid = Bid::where('id', $request->id)->first();
        $bid->update(['status'=>'Completed']);
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

        $bids = Bid::where(['auction_id', $request->id]);
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

    public function getSearchResults(Request $request)
    {
        $results = Auction::where('product_title', 'like', '%' . $request->term . '%')->get();
        if($results)
        {
            return response()->json(['results' => $results]);
        }
        else
        {
            return response()->json(['results' => []]);
        }
    }

    public function createCheckoutSession(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51KbPGNAdVJ1r9ZbYvuFx23kSfdYfebVafD5aNaYgs22TDDrR9Sq9EDIDgtpAO9AzN5nWg4zIFFvvl5Dv8H8mfBza00NGtSaY7K'
        );
        $session = $stripe->checkout->sessions->create([
            // 'billing_address_collection' => 'required',
            'success_url' => 'https://auctionhut.store/checkout?sc_checkout=success&sc_sid={CHECKOUT_SESSION_ID}&amount='.$request->amount,
            'cancel_url' => 'https://auctionhut.store/checkout?sc_checkout=cancel',
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'name' => "Buy ". $request->product_title ,
                    'images' => ['https://firebasestorage.googleapis.com/v0/b/auctionhut-dfa60.appspot.com/o/--1024JPG-01.jpg?alt=media&token=31cd1e5f-5105-4bf4-af6c-57e6e78846a8'],
                    'amount' => $request->amount * 100,
                    'currency' => 'USD',
                    'quantity' => '1',
                ],
            ],

            'mode' => 'payment',
            'customer_email' => $request->email
        ]);


        return $session->id;
    }

    public function __construct()
    {
        $this->middleware('auth:api_user');
    }
}
