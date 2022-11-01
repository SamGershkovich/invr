<?php

namespace App\Http\Controllers;

use App\Models\Shrink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShrinkController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $shrink = Shrink::find($input['shrink_id']);
        if (empty($shrink)) {
            return $this->sendError('Shrink not found');
        }
        $shrink->quantity = $input['shrink'];
        $shrink->save();

        return response([
            'shrink' => $shrink,
        ]);
    }
}
