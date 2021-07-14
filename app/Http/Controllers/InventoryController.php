<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function places_index()
    {

        return view('inventory.places');
    }
    public function place_show(Place $place)
    {
        return view('inventory.places_show', compact('place'));
    }
    public function products_index(Request $request, $is_active=1)
    {
        $query = "";
        $query = $request->search;
        $products = Product::search($query)->sortable(['name' => 'asc'])->where('is_active', '=', $is_active)->paginate(12);
        return view('inventory.products')->with('products',$products);
    }
}
