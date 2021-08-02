<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use App\Jobs\ImportProduct;
use App\Models\Place;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

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
            /* return $_FILES["file"]; */
            $ruta=public_path('storage/'.$_FILES["file"]['name']);
        move_uploaded_file($_FILES["file"]["tmp_name"],$ruta );
        $import= new ProductsImport;
        ImportProduct::dispatch($import, $ruta);
        
        $totalRows = $import->getRowCount();
        return 'Se han insertado '.$totalRows.' Filas';
        } catch (\Throwable $th) {
            return "$th";
        }
    }
    public function printCodes()
    {
        $products = Product::get();
        $pdf = PDF::loadview('pdfs.codes', ['products' => $products]);
        return $pdf->stream('codes.pdf');
    }
   
}
