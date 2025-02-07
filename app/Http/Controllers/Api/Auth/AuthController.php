<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Repository\IUserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $user;
    public function __construct(IUserRepository $user)
    {
        $this->user = $user;
    }

    public function register(Request $request)
    {
        //dd($request->all());
        $validatedData = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'how_you_want_to_use' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'currency' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'avatar' => 'nullable|string|max:255',
            'referal_username' => 'nullable|string|max:255',
            'referal_code' => 'nullable|string|max:255',
            'role_id' => 'required|string|max:255',
        ]);

        //dd($validatedData);

        if(!$validatedData)
        {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'data' => $validatedData
            ], 400);
        }

        $user = $this->user->create([$validatedData]);

        $user->addRole($validatedData['role_id']);

         $token = $user->createToken('API Token')->plainTextToken;

         return response()->json([
             'status' => true,
             'message' => 'User registered successfully',
             'data' => $user,
             'token' => $token,
         ], 201);
    }
}
