<?php

namespace App\Imports;

use App\Models\Car as car_Modal;
use Maatwebsite\Excel\Concerns\ToModel;

class Car implements ToModel{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row){
        if(isset($row[0]) && isset($row[2]) && isset($row[3]) && isset($row[4]) && isset($row[5]) && isset($row[6])){
            return new car_Modal([
                'name' => $row[0],
                'description' => $row[1],
                'make' => $row[2],
                'trim'=> $row[3], 
                'drive_range'=> $row[4], 
                'charger_type'=> $row[5], 
                'charging_time' => $row[6],
            ]);
        }
        
    }
}
