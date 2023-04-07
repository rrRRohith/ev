<?php

namespace App\Imports;

use App\Models\Station as station_Model;
use Maatwebsite\Excel\Concerns\ToModel;

class Station implements ToModel{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row){
        if(isset($row[0]) && isset($row[2]) && isset($row[3]) && isset($row[4]) && isset($row[5]) && isset($row[6]) && isset($row[7])){
            return new station_Model([
                'name' => $row[0],
                'description' => $row[1],
                'address' => $row[2],
                'price'=> $row[3], 
                'charger_type'=> $row[4], 
                'charging_speed'=> $row[5], 
                'latitude' => $row[6],
                'longitude' => $row[7],
            ]);
        }
    }
}
