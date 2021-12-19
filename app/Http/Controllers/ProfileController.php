<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $user->update($request->except('image', 'password'));
        if ($request->has('password') && $request->password !=null){
            $user->update(['password' => Hash::make($request->password)]);
        }
        $user->updateImage();
//dd($request);
        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }
}
