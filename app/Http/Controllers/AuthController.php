<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use App\Events\MessageSent;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'employee_number' => 'required|integer|exists:users,employee_number',
            'password' => ['required'],
            'remember' => 'boolean',
        ]);

        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 422);
        }

        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);
/*
        $input = $request->all();
        $message = Message::create($input);

        $id = $message->id;
        $message = $message->join('users as u', DB::raw('u.id'), "=", DB::raw('messages.user_id'))
            ->where('messages.id', $id)
            ->join('roles as r', DB::raw('r.id'), "=", DB::raw('u.role_id'))
            ->select(
                DB::raw('messages.*'),
                DB::raw("DATE_FORMAT(messages.created_at, '%b %d, %Y') as date"),
                DB::raw("DATE_FORMAT(messages.created_at, '%h:%i %p') as time"),
                DB::raw('u.id as user_id'),
                DB::raw('u.name as user_name'),
                DB::raw('r.name as role'),
            )->get();

        $user = Auth::user();
        event(new MessageSent($user, $message->toArray()));

        return response([
            'messages' => $message->toArray(),
        ]);*/
    }

    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response([
            'success' => true
        ]);
    }
}
