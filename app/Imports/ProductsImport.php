<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Illuminate\Routing\Route;




use Illuminate\Support\Str;

class ProductsImport implements ToModel,  SkipsOnError
{
   use Importable;
   private $rows=0;
    public function model(array $row)
    {
        ++$this->rows;
        return new Product([
            'name'=>$row[0],
             'meta'=>$row[1],
             'stock'=>$row[2],
             'price'=>$row[3],
             'cost'=>$row[4],
             'slug'=>Str::slug($row[0]),
             'place_id'=>1,
             'is_product'=>1,
             'category_id'=>1,
        ]);
        
    }
    public function onError(\Throwable $e)
    {
        --$this->rows;
    }
    public function getRowCount():int
    {
       return $this->rows;
    }
}
