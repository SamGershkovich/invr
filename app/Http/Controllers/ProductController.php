<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function search(Request $request)
    {
        $input = $request->all();
        $categories = json_decode($input['categories']);
        $sub_categories = json_decode($input['sub_categories']);
        //$country_of_origins = json_decode($input['country_of_origins']);

        $products = [];

        try {
            $products = DB::table("products as p")
                ->where(DB::raw('p.id'), '=', $input['id']);
        } catch (Exception $e) {
            $products = DB::table("products as p")
                ->where(DB::raw('p.name'), 'like', '%' . $input['query'] . '%');
        }

        if (!empty($categories)) {
            $products = $products->whereIn(DB::raw('p.category_id'), $categories);
        }
        if (!empty($sub_categories)) {
            $products = $products->whereIn(DB::raw('p.sub_category_id'),  $sub_categories);
        }
        if (!empty($country_of_origins)) {
            //->where(DB::raw('p.country_of_origin_id'), 'in', '(' . $country_of_origins . ')')
        }

        $products = $products->join('inventory as i', DB::raw('i.product_id'), "=", DB::raw('p.id'))->where(DB::raw('cast(i.inventory_date as date)'), '=', DB::raw('cast(now() as date)'));
        $products = $products->join('shrink as s', DB::raw('s.inventory_id'), "=", DB::raw('i.id'));

        $products = $products->join('categories as c', DB::raw('c.id'), "=", DB::raw('p.category_id'))
            ->join('sub_categories as sc', DB::raw('sc.id'), "=", DB::raw('p.sub_category_id'))
            ->select(
                DB::raw('p.*'),
                DB::raw('c.name as category_name'),
                DB::raw('sc.name as sub_category_name'),
                DB::raw('i.id as inventory_id'),
                DB::raw('i.front_quantity as front_quantity'),
                DB::raw('i.back_quantity as back_quantity'),
                DB::raw('i.front_perpetual as front_perpetual'),
                DB::raw('i.back_perpetual as back_perpetual'),
                DB::raw('s.quantity as shrink'),
                DB::raw('s.id as shrink_id'),
            )->get();



        if (empty($products)) {
            return $this->sendError('Products not found');
        }

        return response([
            'products' => $products->toArray(),
        ]);
    }
}
