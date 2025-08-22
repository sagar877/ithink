<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiUserService;
use App\Models\ApiUser;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $apiUserService;

    public function __construct(ApiUserService $apiUserService)
    {
        $this->apiUserService = $apiUserService;
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = ApiUser::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;;
        $user->api_token = $token;
        $user->save();

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Use service to get user
        $user = $this->apiUserService->getApiUserByUsername($request->username);

        if (!$user || Hash::check($request->password, $user->password) === false) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'message' => 'Login successful',
        ]);
    }
}
