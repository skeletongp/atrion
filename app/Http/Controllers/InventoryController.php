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
        try {
            $ruta=public_path('storage/avatars.xlsx');
        move_uploaded_file($_FILES["file"]["tmp_name"],$ruta );
        $import= new ProductsImport;
        Excel::import($import, $ruta);
        
        $totalRows = $import->getRowCount();
        return $totalRows;
        } catch (\Throwable $th) {
            return "Verifique los datos e intente nuevamente";
        }
    }
   
}
