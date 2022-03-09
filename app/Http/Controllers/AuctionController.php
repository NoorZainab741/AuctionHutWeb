<?php

namespace App\Http\Controllers;

use App\Auction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auctions = Auction::get();
        return view('auction.index',compact('auctions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
//        $admin = Admin::where('email', 'admin@system.com')->first();
//        $admin->notify(new PostCreationNotification($post));
        return redirect(route('auctions.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auction = Auction::findOrFail($id);
        return view('auction.show', compact('auction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auction = Auction::findOrFail($id);
        return view('auction.edit', compact('auction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auction $auction)
    {
        $imagePath = array();
        $userID = auth()->user()->id;
//        dd($request->toArray());
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
        return redirect(route('auctions.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $auction = Auction::findOrFail($id);
        $auction->delete();
        return redirect()->back();
    }
}
