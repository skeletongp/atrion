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
use Illuminate\Support\Facades\Auth;
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
        if (strtolower($row[6])=='producto') {
           $type=1;
        } else {
           $type=0;
        }
        
        return new Product([

            'name'=>substr($row[0], 0, 25),
            'code'=>str_pad(rand(1,1500), 10, '0', STR_PAD_LEFT),
             'meta'=>$row[1],
             'stock'=>$row[2],
             'price'=>$row[3],
             'cost'=>$row[4],
             'slug'=>Str::slug($row[0]),
             'place_id'=>Auth::user()->place_id,
             'is_product'=>$type,
             'category_id'=>$cat_id,
        ]);
       
        
    }
    public function onError(\Throwable $e)
    {
      
        --$this->rows;
        return $e;
    }
    public function getRowCount():int
    {
       return $this->rows;
    }
}
