<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api_user', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'These credentials do not match our records'], 401);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create($request->all());

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        $token = $this->guard()->login($user);
        return $this->respondWithToken($token);

//         return new UserResource(['User' => $user]);

    }

    function profile(Request $request)
    {
        if($request->password == '')
        {


            $user = User::where('id',$request->id )->first();
            $user->update($request->except('image','password'));
            if ($request->hasFile('image'))
            {
                $image_path = $request->file('image')->store('user/'.$user->id.'/image', 'public');
                $user->update([
                    'image' => $image_path
                ]);
            }
            if($user)
            {
                return response()->json(["profile" => "update"]);
            }else
            {
                return response()->json(["profile" => "Profile Not Updated"]);
            }
        }else
        {

            $user = User::where('id',$request->id )->first();
            $user->update($request->except('password','image'));
            $user->update([
                "password" => Hash::make($request->password)
            ]);
            if ($request->hasFile('image'))
            {
                $image_path = $request->file('image')->store('user/'.$user->id.'/image', 'public');
                $user->update([
                    'image' => $image_path
                ]);
            }


            if($user)
            {
                return response()->json(["profile" => "update"]);
            }else
            {
                return response()->json(["profile" => "Profile Not Updated"]);
            }
        }
    }

    function viewProfile(Request $request)
    {
        $user = User::where('id',$request-> id)->first();
        if($user)
        {
            return response()->json(["User" => $user]);
        }else
        {
            return response()->json(["User" => []]);
        }
    }
    function updateFcm(Request $request)
    {
        $user = User::where('id',$request-> id)->first();
        $user->update(['fcm_token'=> $request->fcm_token]);
        if($user)
        {
            return response()->json(["User" => $user]);
        }else
        {
            return response()->json(["User" => []]);
        }
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 3600,
            'user' => new UserResource(auth('api_user')->user())
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api_user');
    }

}
