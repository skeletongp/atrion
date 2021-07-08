<?php

namespace App\Http\Controllers;

use App\Models\Place;
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
    public function products_index()
    {
       return view('inventory.products');
    }
}
