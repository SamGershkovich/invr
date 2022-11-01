<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMessages()
    {
        $messages = DB::table("messages as m");

        $messages = $messages->join('users as u', DB::raw('u.id'), "=", DB::raw('m.user_id'))
            ->join('roles as r', DB::raw('r.id'), "=", DB::raw('u.role_id'))
            ->select(
                DB::raw('m.*'),
                DB::raw("DATE_FORMAT(m.created_at, '%b %d, %Y') as date"),
                DB::raw("DATE_FORMAT(m.created_at, '%h:%i %p') as time"),
                DB::raw('u.id as user_id'),
                DB::raw('u.name as user_name'),
                DB::raw('r.name as role'),
                DB::raw('r.id as role_id'),
            )->get();


        if (empty($messages)) {
            return $this->sendError('Messages not found');
        }

        return response([
            'messages' => $messages->toArray(),
        ]);
    }

    public function store(Request $request)
    {
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
                DB::raw('r.id as role_id'),
            )->get();

        $user = User::find($input['user_id']);
        event(new MessageSent($user, $message->toArray()[0]));

        return response([
            'messages' => $message->toArray(),
        ]);
    }
}
