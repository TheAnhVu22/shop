<?php

namespace App\Imports;

use App\Models\CategoryProduct;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CategoryProduct([
            'category_name' => $row[0],
            'category_desc' => $row[1],
            'category_status' => $row[2],
            'category_slug' =>$row[3],
        ]);
    }
}
