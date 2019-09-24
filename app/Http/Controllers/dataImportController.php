<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class dataImportController extends Controller
{
    public function importUnits(){
        $units = [
            "AS" => "Assortment",
            "BG" => "Bag",
            "BA" => "Bale",
            "BI" => "Bar",
            "BX" => "Box",
            
        ];

        foreach ($units as $key => $value) {
            
            DB::table('units')->insert([
                'unit_code' => $key,
                'unit_name' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }

    }
}
