<?php

namespace App\Imports;

use App\Models\Category;
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
        $category=Category::where('name','like','%'.$row[5].'%')->first();
        if ($category) {
           $cat_id=$category->id;
        } else {
            $cat_id=1;
        }
        if ($row[6]=='producto'||$row[6]=='Producto') {
           $type=1;
        } else {
           $type=0;
        }
        
        return new Product([

            'name'=>$row[0],
             'meta'=>$row[1],
             'stock'=>$row[2],
             'price'=>$row[3],
             'cost'=>$row[4],
             'slug'=>Str::slug($row[0]),
             'place_id'=>1,
             'is_product'=>$type,
             'category_id'=>$cat_id,
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
