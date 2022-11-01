<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();
        switch($input['type']){
            case 'inventory':
                return $this->inventoryReport($input['date']);
            case 'shrink':
                return $this->shrinkReport($input['date']);
        }
    }

    function inventoryReport($date){

        $inventory = DB::table('inventory')
            ->join('products', 'inventory.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
            //->join('country_of_origins', 'products.country_of_origin_id', '=', 'country_of_origins.id')
            ->select('inventory.*', 'products.name', 'categories.name as category', 'sub_categories.name as sub_category')
            ->where(DB::raw('cast(inventory.inventory_date as date)'), $date)
            ->get();
        
        return response([
                'report' => $inventory,
            ]);
    }

    function shrinkReport($date){

        $shrink = DB::table('shrink')
            ->join('inventory', 'shrink.inventory_id', '=', 'inventory.id')
            ->join('products', 'inventory.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
            //->join('country_of_origins', 'products.country_of_origin_id', '=', 'country_of_origins.id')
            ->select('shrink.*', 'products.name', 'products.weighted_product', 'products.amount_in_case', 'categories.name as category', 'sub_categories.name as sub_category')
            ->where(DB::raw('cast(inventory.inventory_date as date)'), $date)
            ->whereNotNull('quantity')
            ->get();
        
        return response([
                'report' => $shrink,
            ]);

    }
}
