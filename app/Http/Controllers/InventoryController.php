<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $inventory = Inventory::find($input['inventory_id']);
        if (empty($inventory)) {
            return $this->sendError('Inventory not found');
        }
        $inventory->front_quantity = $input['front_quantity'];
        $inventory->back_quantity = $input['back_quantity'];
        $inventory->front_perpetual = $input['front_perpetual'];
        $inventory->back_perpetual = $input['back_perpetual'];
        $inventory->save();

        return response([
            'inventory' => $inventory,
        ]);
    }
}
