<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Interface\Service\AuthenticationServiceInterface;
use Illuminate\Http\Request;
use App\Models\People;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private $authenticationService;

    public function __construct(AuthenticationServiceInterface $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function login(AuthRequest $request)
    {
        return $this->authenticationService->authenticate($request);
    }

    public function logout(Request $request)
    {
        return $this->authenticationService->unauthenticate($request);
    }

    public function user_register(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'email' => 'required|string|email|max:255|unique:people',
                'password' => 'required|string|min:6',
            ]);

            //create token
            $token = Str::random(60);

            // Create new People record with individual fields
            $person = People::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'password' => Hash::make($request->password),
                'qr_code' => $request->qr_code,
                'token' => $token,
                'role' => 'user', // Default role
                'status' => 'active' // Default status
            ]);

            return response()->json([
                'message' => 'Registration successful',
                'person' => $person,
                'token' => $token
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function user_login(Request $request)
    {
        //check if user exists
        $user = People::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        //check if password is correct
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid password'], 401);
        }

        //generate token
        $token = Str::random(60);
        $user->token = $token;
        $user->save();
        
        return response()->json(['message' => 'Login successful', 'user' => $user, 'token' => $token]);
    }

    public function user_validation(Request $request)
    {
        $person = People::where('id', $request->id)->first();
        if (!$person) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($person->email !== $request->email) {
            return response()->json(['message' => 'Invalid email'], 401);
        }

        if ($person->token !== $request->token) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        return response()->json(['message' => 'User found', 'person' => $person, 'valid' => true]);
    }

    public function validate_forgot_password(Request $request)
    {

        try {
            //required fields
        $request->validate([
            'qr_code' => 'required|string',
            'user_id' => 'required|string',
            'email' => 'required|string|email',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
        ]);
        
        $person = People::where('qr_code', $request->qr_code)->first();
        if (!$person) {
            return response()->json(['message' => 'User not found'], 404);
        }
       
        if($person->id !== intval($request->user_id)) {
            return response()->json(['message' => 'Invalid user id'], Response::HTTP_UNAUTHORIZED);
        }

        if ($person->email !== $request->email) {
            return response()->json(['message' => 'Invalid email'], 401);
        }

            return response()->json(['message' => 'Forgot password validation successful', 'person' => $person, 'valid' => true], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Forgot password validation failed', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function reset_password(Request $request)
    {
        try {
            //change password
            $person = People::where('id', $request->user_id)->first();
            $person->password = Hash::make($request->password);
            $person->save();
            
            return response()->json(['message' => 'Reset password successful', 'person' => $person, 'valid' => true], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Reset password failed', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
