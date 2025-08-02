<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function CustomerStore(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email',
            'phone'   => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        // Create the user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'password' => bcrypt('sajjecocraft@123'),
            'role'     => 'customer'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Customer created successfully',
            'data'    => $user
        ], 201);
    }
}