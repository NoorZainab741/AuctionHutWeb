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
    public function createCheckoutSession(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51KbPGNAdVJ1r9ZbYvuFx23kSfdYfebVafD5aNaYgs22TDDrR9Sq9EDIDgtpAO9AzN5nWg4zIFFvvl5Dv8H8mfBza00NGtSaY7K'
        );
        $session = $stripe->checkout->sessions->create([
            // 'billing_address_collection' => 'required',
//            'success_url' => 'https://lincs.store/customer/completeCoinsPurchasing?sc_checkout=success&sc_sid={CHECKOUT_SESSION_ID}&amount='.$request->amount,
//            'cancel_url' => 'https://lincs.store/customer?sc_checkout=cancel',
            'success_url' => 'http://127.0.0.1:8000/customer/completeCoinsPurchasing?sc_checkout=success&sc_sid={CHECKOUT_SESSION_ID}&amount='.$request->amount,
            'cancel_url' => 'http://127.0.0.1:8000/customer?sc_checkout=cancel',
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'name' => "Buy ". $request->amount*2 ." Coins from LINCS",
                    'images' => ['https://firebasestorage.googleapis.com/v0/b/lincs-312010.appspot.com/o/logo.png?alt=media&token=900b3c73-bd46-484c-a85f-6b04441a4bcb'],
                    'amount' => $request->amount * 100,
                    'currency' => 'PKR',
                    'quantity' => '1',
                ],
            ],

            'mode' => 'payment',
            'customer_email' => auth()->user()->email
        ]);

        return $session->id;
    }
    public function __construct()
    {
        $this->middleware('auth:api_user');
    }
}
