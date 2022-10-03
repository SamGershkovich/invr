<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function getComments(Request $request)
    {
        $input = $request->all();

        $comments = DB::table("comments as c")
            ->where(DB::raw('c.inventory_id'), '=', $input['inventory_id']);

        $comments = $comments->join('users as u', DB::raw('u.id'), "=", DB::raw('c.user_id'))
            ->select(
                DB::raw('c.*'),
                DB::raw("TIME_FORMAT(c.created_at, '%r') as time"),
                DB::raw('u.name as user_name'),
            )->get();


        if (empty($comments)) {
            return $this->sendError('Comments not found');
        }

        return response([
            'comments' => $comments->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $comment = Comment::create($input);
        $id = $comment->id;
        $comment = $comment->join('users as u', DB::raw('u.id'), "=", DB::raw('comments.user_id'))
            ->select(
                DB::raw('comments.*'),
                DB::raw("TIME_FORMAT(comments.created_at, '%r') as time"),
                DB::raw('u.name as user_name'),
            )->where('comments.id', '=', $id)->get();


        return response([
            'comments' => $comment->toArray(),
        ]);
    }
}
