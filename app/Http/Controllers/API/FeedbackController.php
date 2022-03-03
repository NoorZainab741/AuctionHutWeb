<?php

namespace App\Http\Controllers\API;

use App\Bid;
use App\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    public function getFeedbackForAuction(Request $request)
    {
        $data = Feedback::where(['auction_id' => $request->auction_id])->get()->first();
        if($data)
        {
            return response()->json(['feedback' => $data]);
        }
        else
        {
            return response()->json(['feedback' => []]);
        }
    }

    public function createFeedback(Request $request)
    {
        $feedback = Feedback::create($request->all());

        if($feedback)
        {
            return response()->json(['feedback' => "yes"]);
        }
        else
        {
            return response()->json(['feedback' => "no"]);
        }
    }

}
