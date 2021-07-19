<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use App\Models\Place;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
    public function products_upload()
    {
        move_uploaded_file($_FILES["file"]["tmp_name"], public_path('storage/avatars.xlsx'));
        $import= new ProductsImport;
        Excel::import($import, public_path('storage/avatars.xlsx'));
        
        $totalRows = $import->getRowCount();
        return $totalRows;
    }
}
